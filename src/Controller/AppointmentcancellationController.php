<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Email;

class AppointmentcancellationController extends Controller
{
    public function initialize(){
        parent::initialize();		
		$this->loadComponent('Emailer');		
		 
	 $role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
	 
	 $clinic_id = $this->request->getSession()->read('clinic_id') ? $this->request->getSession()->read('clinic_id') : ""; 
	 
	 $users_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : ""; 
	
	if(!$users_id){
		$this->redirect(['controller'=>'Login','action'=>'index']);
			}
	}
	
    public function index()
    {		
    $todayDate = date('Y-m-d'); 
	
	$patients = TableRegistry::get('patient_details')->find()->where(["clinic_id"=>$this->request->getSession()->read('clinic_id')])->enableHydration(false)->toArray();
	
    if($this->request->getSession()->read('role_id')==1) {
	  
	 $data = TableRegistry::get('doctor_details')->find()->where(["clinic_id"=>$this->request->getSession()->read('clinic_id'),'is_active'=>1])->enableHydration(false);
	 	 
	 $appointment = TableRegistry::get('appointment_details')->find()->where(["clinic_id"=>$this->request->getSession()->read('clinic_id'), "appointment_date1 =" =>$todayDate])->enableHydration(false)->toArray();
	 	
	 }
	 
	 else if($this->request->getSession()->read('role_id')==2) {
		 
	    $data = TableRegistry::get('doctor_details')->find()->where(["users_id"=>$this->request->getSession()->read('users_id'),"clinic_id"=>$this->request->getSession()->read('clinic_id'),'is_active'=>1])->enableHydration(false)->toArray();
     
	    $dataID = $data[0]['id']?$data[0]['id']:'';
	  
        $appointment = TableRegistry::get('appointment_details')->find()->where(["clinic_id"=>$this->request->getSession()->read('clinic_id'), "appointment_date1 =" =>$todayDate,'doctor_id'=>$dataID])->enableHydration(false)->toArray();
	  
	 }
	 
	 $this->set(compact('data','patients','appointment'));
    }
	
	public function selectAppointments()
    {
	$con=ConnectionManager::get('default');
    $this->autoRender=false;		
	$this->viewBuilder()->setLayout(false);
	
	$doctor_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : ""; 
	
	 $id=isset($_GET['id'])?$_GET['id']:'';
     $appointed_date=isset($_GET['appointed_date'])?$_GET['appointed_date']:'';
	$firstdate=isset($_GET['first_date'])?$_GET['first_date']:'';
	$secondate=isset($_GET['second_date'])?$_GET['second_date']:'';
	
	if($id && $appointed_date){
    $date=date_create($appointed_date);
    $date_for=date_format($date,"Y-m-d"); 
	$time1=date_create(isset($_GET['time_start'])?$_GET['time_start']:'08:00:00');
	$time2=date_create(isset($_GET['time_end'])?$_GET['time_end']:'23:00:00');	
    $time_start1=date_format($time1,"H:i:s")?date_format($time1,"H:i:s"):'';  
	$time_end1=date_format($time2,"H:i:s")?date_format($time2,"H:i:s"):'';
	  	
	$list = TableRegistry::get('appointment_details')->find()->where(["doctor_id"=>$id, "appointment_date1"=>$date_for, "clinic_id"=>$this->request->getSession()->read('clinic_id'),
	array("appointment_time1 >=" =>$time_start1,"appointment_time1 <=" =>$time_end1)])->enableHydration(false)->toArray();
	//echo '<pre>'; print_r($list); die;
	 
	} else if($id && $firstdate && $secondate){	
	 $date2=date_create($firstdate);
     $first_date=date_format(isset($date2)?$date2:date("Y-m-d"),"Y-m-d"); 
	 $date3=date_create($secondate);
     $second_date=date_format(isset($date3)?$date3:date("Y-m-d"),"Y-m-d"); 
	
	$list = TableRegistry::get('appointment_details')->find()->where(["doctor_id"=>$id,"clinic_id"=>$this->request->getSession()->read('clinic_id'),
	array("appointment_date1 >=" =>$first_date,"appointment_date1 <=" =>$second_date)])->enableHydration(false)->toArray();
	//echo '<pre>'; print_r($date_result); die;
	 }
	 
	$data = TableRegistry::get('patient_details')->find()->where(["clinic_id"=>$this->request->getSession()->read('clinic_id')])->enableHydration(false)->toArray();	
	$this->set(compact('data','list'));	 
	 
	 if(!empty($list) &&!empty($data)){		 
	  json_encode($this->render("/Element/Appointmentcancellation/select_doctors"));
	 }
	else
	{
	  json_encode($this->render("/Element/Appointmentcancellation/no_data"));
	}
		
	}
	
    public function deleteAppointment(){
	$appointTable = TableRegistry::get('appointment_details');
	if($this->request->is('post')){
	$checkbox = $_POST['check'];
    $message = 	isset($_POST['message']) ? $_POST['message'] : ''; 
	//pre($checkbox); 	
	for($i=0; $i<count($checkbox); $i++){		
	 $appointID = $checkbox[$i];
	 
     $list = TableRegistry::get('appointment_details')->find()->select('patient_id')
	 ->where(["id"=>$appointID,"clinic_id"=>$this->request->getSession()->read('clinic_id')])
	 ->enableHydration(false)->toArray();
	//echo '<pre>'; print_r($list);
	 
     $patientID = isset($list[0]['patient_id']) ? $list[0]['patient_id'] : '' ;
	 
	 $patientEmail = TableRegistry::get('patient_details')->find()->select('email')
	 ->where(["id"=>$patientID])
	 ->enableHydration(false)->toArray();
	 		
	 $updateStatus = $appointTable->updateAll(['bulkcancellation_status'=>0,'bulkcancellation_message'=>$message],["clinic_id"=>$this->request->getSession()->read('clinic_id'), 'id'=>$appointID]);
	 
	  $email[] = isset($patientEmail[0]['email']) ? $patientEmail[0]['email'] : '' ; 	  
    }
	//if(!empty($message)) {						
		$mail = new Email('default');
		$mail->setFrom(['swati@unikove.com' => 'Unikove']);				
		$mail->setTo($email);
		$mail->setSubject('Appointment Cancellation');
		$mail->send("Hi, Your Appointment is cancelled  --Thanks");
			}
	  //}  //echo '<pre>'; print_r($patientEmail); die;
	echo $this->redirect(["controller"=>"appointmentcancellation","action"=>"index"]);
  }	
}

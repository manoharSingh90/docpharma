<?php

namespace App\Controller;
//namespace Cake\View\Helper; 
           
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Http\Exception\InvalidCsrfTokenException;
use Cake\Http\ServerRequest;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\SessionHelper;
use Cake\View\View;
use App\View\Helper\urlHelper;
use Cake\Datasource\ConnectionManager;
class PatientController extends AppController
{
	
	public function initialize()
    {
        parent::initialize();		
		$this->loadComponent('Emailer');
		//$this->loadComponent('Csrf');
		 
	 $role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
	 $users_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : ""; 
	 $clinic_id = $this->request->getSession()->read('clinic_id') ? $this->request->getSession()->read('clinic_id') : ""; 
	
		if(!$users_id){
		$this->redirect(['controller'=>'Login','action'=>'index']);
			}
	}
	
	public function index(){
	 
	 $query = TableRegistry::get('patient_details')->find()->where(["clinic_id"=>$this->request->getSession()->read('clinic_id')]);
	 $this->set(compact('query'));
	 
	}
	
	public function save()
	{
		$formData = $this->request->getData();
		$formData['id'] = $formData['id']?$formData['id']:'';
		$formData['clinic_id'] =  $this->request->getSession()->read('clinic_id');
		$formData['users_id'] =  $this->request->getSession()->read('users_id');
		$formData['m_number'] = implode(",",$formData['m_number']);
		$formData['email'] = implode(",",$formData['email']);
		$formData['country_code'] = implode(",",$formData['country_code']);
		$formData['conditions'] = implode(",",$formData['conditions']);
		$formData['dob'] = str_replace("/","-",$formData['dob']);		
	    $formData['dob'] = date('d M Y',strtotime($formData['dob']));
		//$formData['allergy'] = $formData["old_allergy"] && !empty($formData["old_allergy"]) ? $formData["allergy"].",".$formData["old_allergy"] : $formData["allergy"];
		//$formData['allergy'] = $formData["old_allergy"] && !empty($formData["old_allergy"]) ? implode(",",$formData["allergy"]).",".$formData["old_allergy"] : $formData["allergy"];
		$formData['allergy'] = $formData["allergy"] && !empty($formData["allergy"]) ? implode(",",$formData["allergy"]) : "";
				
		$articlesTable = TableRegistry::get('patient_details');
		$article = $articlesTable->newEntity($formData);
		$article = $articlesTable->save($article);
		
		$patientForm['remarks'] = implode(",",$formData['patient_remark']);
		$patientForm['id'] = $formData['remark_id']?$formData['remark_id']:'';
		$patientForm['users_id'] = $this->request->getSession()->read('users_id');
		$patientForm['patient_id'] = $formData['id']?$formData['id']:$article->id;
		//echo '<pre>'; print_r($formData); die;
		
		$remarkTable = TableRegistry::get('patient_remarks');
		$remark = $remarkTable->newEntity($patientForm);
		$remark = $remarkTable->save($remark);
		
		//$this->Emailer->email($formData);
		
		if(($this->request->getData("pageName")) && ($this->request->getData("pageName")=="Patient"))
		{
		   echo $this->redirect(["controller"=>"Patient","action"=>"index"]);
		}
		else if($this->request->getData("pageName")=="Appointment")
		{
			$_SESSION["patientID"] = $article->id;
			echo $this->redirect(["controller"=>"Appointment","action"=>"index"]);
		}
		else if($this->request->getData("pageName")=="Pharmacy")
		{
		   echo $this->redirect(["controller"=>"Pharmacy","action"=>"billing"]);
		}
		else
		{
		   echo $this->redirect(["controller"=>"Appointment","action"=>"appointment_details",$this->request->getData("pageName")]);
		}
	}
	
	public function patientsDetails($id=null)
	{
	    $patientTable = TableRegistry::get('patient_details');
	    $remarkTable = TableRegistry::get('patient_remarks');
	    $ppTable = TableRegistry::get('pharmacy_prescription');
		
		$data = $patientTable->find()
					  ->select()
					  ->where(["id"=>$id])
					  ->enableHydration(false)					  
					  ->first();
					  
		$remarkData = $remarkTable->find()
					  ->select()
					  ->where(["patient_id"=>$id])
					  ->enableHydration(false)					  
					  ->first();

		$ppData = $ppTable->find()->select()->where(["patient_id"=>$id])->enableHydration(false)->first();
					  
		$this->set(compact("data",'remarkData',"ppData"));
	}
	
	public function patientPmr($patientID)
	{ 
		$conn = ConnectionManager::get('default');
		
		$pmrQuery = $conn->execute('select doctor_details.id AS doctorID, doctor_details.first_name, doctor_details.middle_name, doctor_details.last_name, PP.created_dttm, PPOI.id AS ID, PPOI.prescription_id, PPOI.product_id, PPOI.product_name, PPOI.product_type, PPOI.duration_no, PPOI.duration_frequency, PPOI.total_qty, PPOI.notes, PPOI.day_of_week, PPOI.morning, PPOI.afternoon, PPOI.evening, PPOI.dinner, PPOI.morning_quantity, PPOI.afternoon_quantity, PPOI.evening_quantity, PPOI.dinner_quantity, PPOI.abbreviation, PPOI.abbreviation_meaning FROM pharmacy_prescription AS PP INNER JOIN doctor_details ON doctor_details.id=PP.doctor_id INNER JOIN pharmacy_prescription_order_items AS PPOI ON PP.id=PPOI.prescription_id WHERE PP.patient_id='.base64_decode($patientID).' ');
		$pmrData = $pmrQuery ->fetchAll('assoc');
		
		$productID_dateArray = array();
		$savedPrescription = array();
		if(!empty($pmrData)) {
		foreach(array_reverse($pmrData) as $key => $value)
		{
			$productID_date = $value["product_id"]."_".$value["created_dttm"];
			$createdDate = explode(" ",$value["created_dttm"]);
			$createdDate = $createdDate[0];
			if(!in_array($productID_date,$productID_dateArray))
			{
				$savedPrescription[$createdDate][$key]["ID"] = $value["ID"];
				$savedPrescription[$createdDate][$key]["prescription_id"] = $value["prescription_id"];
				$savedPrescription[$createdDate][$key]["doctorID"] = $value["doctorID"];
				$savedPrescription[$createdDate][$key]["patient_id"] = base64_decode($patientID);
				$savedPrescription[$createdDate][$key]["doctor_name"] = $value["first_name"]." ".$value["middle_name"]." ".$value["last_name"];
				$savedPrescription[$createdDate][$key]["created_dttm"] = $value["created_dttm"];
				$savedPrescription[$createdDate][$key]["product_name"] = $value["product_name"];
				$savedPrescription[$createdDate][$key]["product_type"] = $value["product_type"];
				$savedPrescription[$createdDate][$key]["duration_no"] = $value["duration_no"];
				$savedPrescription[$createdDate][$key]["duration_frequency"] = $value["duration_frequency"];
				$savedPrescription[$createdDate][$key]["total_qty"] = $value["total_qty"];
				$savedPrescription[$createdDate][$key]["day_of_week"] = $value["day_of_week"];
				$savedPrescription[$createdDate][$key]["notes"] = $value["notes"];
				$savedPrescription[$createdDate][$key]["morning"] = $value["morning"];
				$savedPrescription[$createdDate][$key]["afternoon"] = $value["afternoon"];
				$savedPrescription[$createdDate][$key]["evening"] = $value["evening"];
				$savedPrescription[$createdDate][$key]["dinner"] = $value["dinner"];
				$savedPrescription[$createdDate][$key]["morning_quantity"] = $value["morning_quantity"];
				$savedPrescription[$createdDate][$key]["afternoon_quantity"] = $value["afternoon_quantity"];
				$savedPrescription[$createdDate][$key]["evening_quantity"] = $value["evening_quantity"];
				$savedPrescription[$createdDate][$key]["dinner_quantity"] = $value["dinner_quantity"];
				$savedPrescription[$createdDate][$key]["abbreviation"] = $value["abbreviation"];
				$savedPrescription[$createdDate][$key]["abbreviation_meaning"] = $value["abbreviation_meaning"];
			}
			$productID_dateArray[] =  $value["product_id"]."_".$value["created_dttm"];
		} }
		//echo "<pre>"; print_r($savedPrescription); die;
     
		$this->set(compact("savedPrescription"));	
	}
	
	public function printPmr()
	{
		$conn = ConnectionManager::get('default');
		
		if(!empty($this->request->getData("checkbox")))
		{
			$id = implode(",",$this->request->getData("checkbox"));
			
			$prescriptionQuery = $conn->execute('SELECT doctor_details.first_name AS DFName, doctor_details.middle_name AS DMName,doctor_details.last_name AS DLName, patient_details.title AS PTitle, patient_details.fname AS PFName, patient_details.mname AS PMName, patient_details.lname AS PLName, patient_details.dob AS PDob, patient_details.allergy AS PAllergy, patient_details.address AS PAddress, PPOI.product_name, PPOI.product_type, PPOI.morning, PPOI.afternoon, PPOI.evening, PPOI.dinner, PPOI.morning_quantity, PPOI.afternoon_quantity, PPOI.evening_quantity, PPOI.dinner_quantity, PPOI.abbreviation, PPOI.abbreviation_meaning FROM doctor_details INNER JOIN pharmacy_prescription ON doctor_details.id=pharmacy_prescription.doctor_id INNER JOIN patient_details ON patient_details.id=pharmacy_prescription.patient_id INNER JOIN pharmacy_prescription_order_items AS PPOI ON pharmacy_prescription.id=PPOI.prescription_id WHERE PPOI.id IN ('.$id.')');
			$prescriptionData = $prescriptionQuery ->fetchAll('assoc');
			
			if(!empty($prescriptionData))
			{
				$countData = count($prescriptionData);
				$count=0;
				foreach($prescriptionData as $key => $value)
				{
					$count++;
					if($key==0)
					{
						$explode = explode("_",$value["PAllergy"]);
						$allergy[] = $explode[1];
					}
					if($count==$countData)
					{
						$finalData["start_date"] = $this->request->getData("start_date");
						$finalData["doctor_name"] = $value["DFName"]." ".$value["DMName"]." ".$value["DLName"];
						$finalData["patient_name"] = $value["PTitle"]." ".$value["PFName"]." ".$value["PMName"]." ".$value["PLName"];
						$finalData["patient_dob"] = $value["PDob"];
						$finalData["patient_address"] = $value["PAddress"];
						$finalData["patient_allergy"] = implode(",",$allergy);
					}
					$finalData["medication"][$key]["product_name"] = $value["product_name"];
					$finalData["medication"][$key]["product_type"] = $value["product_type"];
					$finalData["medication"][$key]["morning"] = $value["morning"];
					$finalData["medication"][$key]["afternoon"] = $value["afternoon"];
					$finalData["medication"][$key]["evening"] = $value["evening"];
					$finalData["medication"][$key]["dinner"] = $value["dinner"];
					$finalData["medication"][$key]["morning_quantity"] = $value["morning_quantity"];
					$finalData["medication"][$key]["afternoon_quantity"] = $value["afternoon_quantity"];
					$finalData["medication"][$key]["evening_quantity"] = $value["evening_quantity"];
					$finalData["medication"][$key]["abbreviation"] = $value["abbreviation"];
					$finalData["medication"][$key]["abbreviation_meaning"] = $value["abbreviation_meaning"];
				}
			}
			//echo "<pre>"; print_r($finalData); die;
			$this->set(compact("finalData"));
		}
		else
		{
			echo "No Result Found"; die;
		}
	}
	
	public function searchDOB(){
	
	  $dob = $_GET['dob'] ? $_GET['dob'] : '';
	  $strplc = str_replace("/","-",$dob);	 
	  $dob2 = date_create($strplc);
	  $dateForm = date_format($dob2,'d M Y');	 
	
	$list = TableRegistry::get('patient_details')->find()
	->where(['dob'=>$dateForm])
	->enableHydration(false)
	->toArray();
    //print_r($list); die;
    $this->set(compact("list"));
	
	if(!empty($list)){
		
	 json_encode($this->render("/Element/Patient/newely_added"));
	 
	}
	else
	 {
		 
	  json_encode($this->render("/Element/no_data")); 
	  
	 }	
	}
	
	public function alpha(){

	$this->viewBuilder()->setLayout(false);
		
	$this->loadModel('patient_details');	  
    $list = $this->patient_details->find('all' ,['order' => ['fname' => 'ASC']])->where(["clinic_id"=>$this->request->getSession()->read('clinic_id')])->enablehydration(false)->toArray();
       
	$this->set(compact("list"));
	
	if(!empty($list)){
	$html['html'] = $this->render("/Element/Patient/alphabetical_order");
	$html['message'] ='success'; 
	}
	else
	{
	$html['message'] ='error';
	}
	echo json_encode($html);		
	}	
	
	public function newelyAdded(){
		
	//$this->autoRender=false;
	$this->viewBuilder()->setLayout(false);
		
	$this->loadModel('patient_details');	  
    $list = $this->patient_details->find()->order(['id'=>'DESC'])->where(["clinic_id"=>$this->request->getSession()->read('clinic_id')])->enablehydration(false)->toArray();
       
	$this->set(compact("list"));
	//$this->render("/Element/Patient/alphabetical_order");
	
	if(!empty($list)){
	$html['html'] = $this->render("/Element/Patient/newely_added");
	$html['message'] ='success'; 
	}
	else
	{
	$html['message'] ='error';
	}
	echo json_encode($html);
	}
	
	
	/* public function loadMore($id=null){
		//echo $id; die;
	$this->autoRender=false;
	$this->layout=false;
		
	$this->loadModel('patient_details');	  
    $list = $this->patient_details->find()->order(['id'=>'ASC'])->limit(2)->hydrate(false)->toArray();
       
	$this->set(compact("list"));
	//$this->render("/Element/Patient/alphabetical_order");
	
	if(!empty($list)){
	$html['html'] = $this->render("/Element/Patient/load_more");
	$html['message'] ='success'; 
	}
	else
	{
	$html['message'] ='error';
	}
	echo json_encode($html);
	} */
	
    public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
}

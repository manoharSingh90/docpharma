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

class BlackoutController extends AppController
{
	public function initialize()
    {
        parent::initialize();		
		$this->loadComponent('Emailer');
		//$this->loadComponent('Csrf');
		 
	 $role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
	 
	 $clinic_id = $this->request->getSession()->read('clinic_id') ? $this->request->getSession()->read('clinic_id') : ""; 
	  
	 $users_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : ""; 
	
		if(!$users_id){
		$this->redirect(['controller'=>'Login','action'=>'index']);
			}
	}
	
    public function index(){ 
	
	 $role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
	 
	 $clinic_id = $this->request->getSession()->read('clinic_id') ? $this->request->getSession()->read('clinic_id') : ""; 
	 
	 if($role_id==2 && $clinic_id!==""){

	 $query = TableRegistry::get('blackout_details')->find()->where(["clinic_id"=>$this->request->getSession()->read('clinic_id'),"users_id"=>$this->request->getSession()->read('users_id')])->enableHydration(false)->toArray();
	 
	 //echo '<pre>'; print_r($query);
	 }
	 
	 else if($role_id==1 && $clinic_id!==""){
	 $query = TableRegistry::get('blackout_details')->find()->where(["clinic_id"=>$this->request->getSession()->read('clinic_id')]);
	 }
	 
	 $doctbl = TableRegistry::get('doctor_details')->find()->where(["clinic_id"=>$this->request->getSession()->read('clinic_id'),'is_active'=>1])->enableHydration(false)->toArray();
	 
	 $this->set(compact('query','doctbl'));  
	 
	}
	
	public function save(){
		
	$formData = $this->request->getData();	
	$id = $formData['doctor_id'];
	$formData['users_id'] = $this->request->getSession()->read('users_id');
	$formData['clinic_id'] = $this->request->getSession()->read('clinic_id');
	 $s1=date_create($formData['start_time']);	
     $st=date_format($s1,"h:i"); 
     $s2=date_create($formData['end_time']);	
     $end=date_format($s2,"h:i"); 
	 
	//print_r($formData); die;
	 $formData['start_time'] = implode(" ",array('start'=>isset($formData['start_time'])?$formData['start_time']:'','mm'=>isset($formData['amtime'])?$formData['amtime']:''));
	
	 $formData['end_time'] = implode(" ",array('end'=>isset($formData['end_time'])?$formData['end_time']:'','mm'=>isset($formData['pmtime'])?$formData['pmtime']:''));
	
	$exp_date = isset($formData['blackout_date'])?explode('-',$formData['blackout_date']):'';
	$date1=date_create($exp_date[0]);
    echo $date_first=date_format($date1,"Y-m-d");
	$date2=date_create($exp_date[1]); echo '<br>';
    echo $date_second=date_format($date2,"Y-m-d");
	echo '<br>';
	$time1=date_create(isset($formData['start_time'])?$formData['start_time']:'08:00:00');
	$time2=date_create(isset($formData['end_time'])?$formData['end_time']:'23:00:00');	
    echo $time_start1=date_format($time1,"H:i")?date_format($time1,"H:i"):'';  echo '<br>';
	echo $time_end1=date_format($time2,"H:i")?date_format($time2,"H:i"):'';
	
	$formData['blackout_startdate'] = $date_first;
	$formData['blackout_enddate'] = $date_second;
	$formData['blackout_starttime'] = $time_start1;
	$formData['blackout_endtime'] = $time_end1;
	//print_r($formData); die;
	
    // echo '<pre>'; print_r($formData); die;
	 $articlesTable = TableRegistry::get('blackout_details');
	 $article = $articlesTable->newEntity($formData);
	 $article = $articlesTable->save($article);
	 
	 echo $this->redirect(["controller"=>"blackout","action"=>"index"]);
	 }
	
    public function createBlackoutDate($id=null){
	
	 if($this->request->getSession()->read('role_id')==1) {
	 $data = TableRegistry::get('doctor_details')->find()->where(["clinic_id"=>$this->request->getSession()->read('clinic_id'),'is_active'=>1])->enableHydration(false);
	 }
	 else {
	 $data = TableRegistry::get('doctor_details')->find()->where(["users_id"=>$this->request->getSession()->read('users_id'),'is_active'=>1])->enableHydration(false)->toArray();
	 }
	 
	 //echo '<pre>'; print_r($data); die;
	
	 $query = TableRegistry::get('blackout_details');
	 $valuee = $query->find()
					  ->select()
					  ->where(["id"=>$id])
					  ->enableHydration(false)					  
					  ->first();
	 $this->set(compact('valuee','data'));	
		
    }
	 public function removeBlackout($id=null){
    
	 $query = TableRegistry::get('blackout_details');		  	
	 
	 $appointbl = TableRegistry::get('blackout_details')->get($id);	
	 $result = TableRegistry::get('blackout_details')->delete($appointbl);  
	 
	 echo $this->redirect(["controller"=>"blackout","action"=>"index"]); 
	 }
	
  }

<?php

namespace App\Controller;
                 
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Http\Exception\InvalidCsrfTokenException;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\SessionHelper;
use Cake\View\Helper\FlashHelper;

class CustomerController extends AppController
{
	/* public function index(){
		
	$query = TableRegistry::get('customer_details')
	->find();
	 $this->set(compact('query'));
	}
	public function save($id=null){
		
		$formData = $this->request->getData();
		$formData['phone_code'] = implode(",",$formData['phone_code']);
		$formData['phone'] = implode(",",$formData['phone']);
		$formData['email'] = implode(",",$formData['email']);
		$formData['address'] = implode(",",$formData['address']);
		if(!empty($formData['longitude'])){
		$formData['longitude'] = implode(",",$formData['longitude']);}
		if(!empty($formData['latitude'])){
		$formData['latitude'] = implode(",",$formData['latitude']);}
		$formData['city'] = implode(",",$formData['city']);
		$formData['state'] = implode(",",$formData['state']);
		$formData['country'] = implode(",",$formData['country']);
		$formData['pincode'] = implode(",",$formData['pincode']);
		if(!empty($formData['allergies'])){
		$formData['allergies'] = implode(",",$formData['allergies']); }
		if(!empty($formData['conditions'])){
		$formData['conditions'] = implode(",",$formData['conditions']);  }
		if(!empty($formData['other_conditions'])){
		$formData['other_conditions'] = implode(",",$formData['other_conditions']); }
		if(!empty($formData['other_allergies'])){
		$formData['other_allergies'] = implode(",",$formData['other_allergies']); }
		//echo '<pre>'; print_r($formData); die;
		$articlesTable = TableRegistry::get('customer_details');
		$article = $articlesTable->newEntity($formData);
		$article = $articlesTable->save($article);
		
		echo $this->redirect(["controller"=>"customer","action"=>"index"]);
	} */
	
		public function createCustomer($id=null){
			
		/* $query = TableRegistry::get('customer_details');
		$data = $query->find()
					  ->select()
					  ->where(["id"=>$id])
					  ->enableHydration(false)					  
					  ->first();
		$this->set(compact("data"));
			 */
		}
		
	/* public function customerDetails($id=null){
		
		$query = TableRegistry::get('customer_details');
		$data = $query->find()
					  ->select()
					  ->where(["id"=>$id])
					  ->enableHydration(false)					  
					  ->first();
		$this->set(compact("data"));
	}
	
	public function newelyAdded(){
		
	$this->autoRender=false;
	$this->viewBuilder()->setLayout(false);
		
	$this->loadModel('customer_details');	  
    $list = $this->customer_details->find()->order(['id'=>'DESC'])->enablehydration(false)->toArray();
       
	$this->set(compact("list"));	
	if(!empty($list)){
	$html['html'] = $this->render("/Element/Customer/newely_added");
	$html['message'] ='success'; 
	}
	else
	{
	$html['message'] ='error';
	}
	echo json_encode($html);
	} */
}
 
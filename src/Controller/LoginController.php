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
class LoginController extends AppController
{
	public function index(){
		
	}
	
	public function login(){
		
	$this->autoRender=false;
	$this->viewBuilder()->setLayout(false);
		
	$this->loadModel('users');		
	
	  $data = $this->request->getData();
      //print_r($data); die;
	   if(!empty($data)){
	  $userData = $this->users->find()->select()
	  ->where(["email"=>$data["email"],"password"=>$data["password"]])
	  ->enableHydration(false)
	  ->first();
	  
	  /* $doctor = TableRegistry::get('doctor_details')->find()->select(['id','is_active','email'])
	  //->where(["email"=>$data["email"]])
	  ->enableHydration(false)
	  ->toArray();
	  echo '<pre>'; print_r($doctor["email"]);
	  echo '<pre>'; print_r($doctor); die; */
		
		if($userData){ 
		unset($userData['users']['password']);
		$this->request->getSession()->write('users_id', $userData['id']);
		$this->request->getSession()->write('role_id', $userData['role_id']);
		$this->request->getSession()->write('clinic_id', $userData['clinic_id']);
		$this->request->getSession()->write('emailID', $userData['email']);
		
         if($userData['role_id']==2) {
			 
		    return $this->redirect(['controller' => 'Appointment', 'action' => 'listing']);	
		 
         } else if($userData['role_id']==1 ) {
			 
		    return $this->redirect(['controller' => 'doctor', 'action' => 'listing']); 
		 
		 }		
		
		else if($userData['role_id']==4)
		{
			return $this->redirect(['controller' => 'Pharmacy', 'action' => 'billing']); 
		}
		
		}else{
        $this->request->getSession()->write('invalid', 'Invalid Login Credentials');  
        $this->Flash->set('Invalid Login Credentials!!', ['element' => 'error']);		
		return $this->redirect(['controller' => 'login', 'action' => 'index']);			
		}
		
	} 
		
}
	public function logout(){
		 
		$this->request->getSession()->destroy();
		$this->redirect(array('controller'=>'login','action'=>'index'));		
		
	}
	
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

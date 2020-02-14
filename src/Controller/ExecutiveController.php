<?php

namespace App\Controller;
                 
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Http\Exception\InvalidCsrfTokenException;
use Cake\Http\ServerRequest;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\SessionHelper;
use Cake\View\View;
use Cake\Mailer\Email;

class ExecutiveController extends AppController
{
	
	public function initialize()
    {
        parent::initialize();		
		$this->loadComponent('Emailer');
		 
	 $role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
	 $users_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : ""; 
	
		if(!$users_id){
		$this->redirect(['controller'=>'Login','action'=>'index']);
			}
	}
	
	public function index(){
	  $query = TableRegistry::get('executive')->find();
	 $this->set(compact('query')); 
	 
	}
	
	public function save()
	{
		$formData = $this->request->getData();
	    $formData['created_by'] =  $this->request->getSession()->read('role_id');
		$formData['phone'] = implode(",",$formData['phone']);
		$formData['email'] = implode(",",$formData['email']);
		$formData['phone_code'] = implode(",",$formData['phone_code']);
		$formData['permission'] = implode(",",$formData['permission']);
		//echo '<pre>'; print_r($formData); die;
		$articlesTable = TableRegistry::get('executive');
		$article = $articlesTable->newEntity($formData);
		$article = $articlesTable->save($article);
		//$this->Emailer->executive_mail($formData);
     echo $this->redirect(["controller"=>"Executive","action"=>"index"]);
	
	}
	
	public function createEa($id=null)
	{
		$this->loadModel('Executive');		
		$data = $this->Executive->find()
									  ->select()
									  ->where(["id"=>$id])
									  ->enableHydration(false)
									  ->first();
		//print_r($data); die;       		
		$this->set(compact("data"));
	
	}
	
	public function eaDetails($id=null)
	{ 
	$this->loadModel('Executive');		
		$data = $this->Executive->find()
									  ->select()
									  ->where(["id"=>$id])
									  ->enableHydration(false)
									  ->first();
		       		
		$this->set(compact("data"));
	
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

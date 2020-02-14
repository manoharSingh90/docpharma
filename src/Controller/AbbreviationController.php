<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\View\Helper\FormHelper;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Filesystem\Folder;
use Cake\Mailer\Email;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class AbbreviationController extends AppController
{
	function index()
	{
		if(isset($this->request->getParam('pass')[0]))
		{
			$amTable = TableRegistry::get('abbreviation_master');
			
			$data = $amTable->find()->select()->where(["id"=>base64_decode($this->request->getParam('pass')[0])])->enableHydration(false)->first();
			$this->set(compact("data"));
		}
	}
	
	function listing()
	{
		$amTable = TableRegistry::get('abbreviation_master');
		
		$abbreviationData = $amTable->find()->select()->enableHydration(false)->toArray();
		$this->set(compact("abbreviationData"));
	}
	
	function save()
	{
		$amTable = TableRegistry::get('abbreviation_master');

		//echo "<pre>"; print_r($this->request->getData()); die;

		$abbreviationData["id"] = $this->request->getData("id") ? $this->request->getData("id") : "";
		$abbreviationData["abbreviation"] = $this->request->getData("abbreviation") ? $this->request->getData("abbreviation") : "";
		$abbreviationData["meaning"] = $this->request->getData("meaning") ? $this->request->getData("meaning") : "";
		if(empty($this->request->getData("id")))
		{
			$abbreviationData["created_dttm"] = date("Y-m-d H:i:s");
		}
		$abbreviationData["modified_dttm"] = date("Y-m-d H:i:s");
		
		$abbreviationSave = $amTable->newEntity($abbreviationData);
		$abbreviationSaveData = $amTable->save($abbreviationSave);
		
		echo $this->redirect(["controller"=>"Abbreviation", "action"=>"listing"]);
	}
	
	public function deleteAbbreviation()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$abbreviationMasterTable = TableRegistry::get('abbreviation_master');
		
		if($this->request->getData("id"))
		{
			$abbreviationMasterTable->deleteAll(['id' => $this->request->getData("id")]);
		}
	}
}
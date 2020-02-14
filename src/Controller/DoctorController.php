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

class DoctorController extends AppController
{
	public function initialize()
    {
        parent::initialize();		
		$this->loadComponent('Emailer');
		 
		$role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
		$users_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : ""; 
	
		if(!$users_id)
		{
			$this->redirect(['controller'=>'Login','action'=>'index']);
		}
	}
	
	function index()
	{
		if(isset($this->request->getParam('pass')[0]))
		{
			$usersTable = TableRegistry::get('users');
			$doctorTable = TableRegistry::get('doctor_details');
			
			$data = $doctorTable->find()
								  ->select()
								  ->where(["id"=>base64_decode($this->request->getParam('pass')[0])])
								  ->enableHydration(false)
								  ->first();
			
			$emailData = isset($data["email"]) ? json_decode($data["email"],true) : "";
			$usersData = $usersTable->find()
								  ->select(["id"])
								  ->where(["email"=>$emailData[0]])
								  ->enableHydration(false)
								  ->first();

			$this->set(compact("usersData","data"));
		}
	}
	
	function listing()
	{
		$doctorTable = TableRegistry::get('doctor_details');
		
		$allData = $doctorTable->find()
							  ->select()
							  ->where(['clinic_id'=>$this->request->getSession()->read('clinic_id')])
							  ->enableHydration(false)
							  ->toArray();
		//echo "<pre>";print_r($allData);die;
		$this->set(compact("allData"));
	}
	
	function save()
	{
		$usersTable = TableRegistry::get('users');
		$doctorTable = TableRegistry::get('doctor_details');
		$doctorTiming = TableRegistry::get('doctor_timings');

		//echo "<pre>"; print_r($this->request->getData()); die;
		$path = WWW_ROOT.'img/images/doctor/';
		$dir = new Folder($path, true, 0755);

		$usersData["id"] = $this->request->getData("users_id") ? $this->request->getData("users_id") : "";
		$usersData["email"] = $this->request->getData("email")[0] ? $this->request->getData("email")[0] : "";
		$usersData["password"] = $this->request->getData("first_name") ? $this->request->getData("first_name") : "";
		$usersData["clinic_id"] = $this->request->getSession()->read('clinic_id');
		$usersData["role_id"] = "2";
		$usersSave = $usersTable->newEntity($usersData);
		$usersSaveData = $usersTable->save($usersSave);
		
		$data = array();
		foreach($this->request->getData("days") as $key => $value)
		{
			foreach($value as $k => $v)
			{
				if(!empty($v))
				{
					//$finalArray[$key] = trim(implode(",",$value),",");
					$finalArray[$key] = trim(preg_replace("/,+/", ",", implode(",",$value)),",");
				}
			}
		}
		
		//$clockArray = array("01:00"=>"01:00", "02:00"=>"02:00", "03:00"=>"03:00", "04:00"=>"04:00", "05:00"=>"05:00", "06:00"=>"06:00", "07:00"=>"07:00", "08:00"=>"08:00", "09:00"=>"09:00", "10:00"=>"10:00", "11:00"=>"11:00", "12:00"=>"12:00", "13:00"=>"01:00", "14:00"=>"02:00", "15:00"=>"03:00", "16:00"=>"04:00", "17:00"=>"05:00", "18:00"=>"06:00", "19:00"=>"07:00", "20:00"=>"08:00", "21:00"=>"09:00", "22:00"=>"10:00", "23:00"=>"11:00", "24:00"=>"12:00");
		
		$clockArray = array("01:00"=>"01:00", "02:00"=>"02:00", "03:00"=>"03:00", "04:00"=>"04:00", "05:00"=>"05:00", "06:00"=>"06:00", "07:00"=>"07:00", "08:00"=>"08:00", "09:00"=>"09:00", "10:00"=>"10:00", "11:00"=>"11:00", "12:00"=>"12:00", "13:00"=>"01:00", "14:00"=>"02:00", "15:00"=>"03:00", "16:00"=>"04:00", "17:00"=>"05:00", "18:00"=>"06:00", "19:00"=>"07:00", "20:00"=>"08:00", "21:00"=>"09:00", "22:00"=>"10:00", "23:00"=>"11:00", "24:00"=>"12:00", "01"=>"01:00", "02"=>"02:00", "03"=>"03:00", "04"=>"04:00", "05"=>"05:00", "06"=>"06:00", "07"=>"07:00", "08"=>"08:00", "09"=>"09:00", "10"=>"10:00", "11"=>"11:00", "12"=>"12:00", "13"=>"01:00", "14"=>"02", "15"=>"03:00", "16"=>"04:00", "17"=>"05:00", "18"=>"06:00", "19"=>"07:00", "20"=>"08:00", "21"=>"09:00", "22"=>"10:00", "23"=>"11:00", "24"=>"12:00", "1"=>"01:00", "2"=>"02:00", "3"=>"03:00", "4"=>"04:00", "5"=>"05:00", "6"=>"06:00", "7"=>"07:00", "8"=>"08:00", "9"=>"09:00");
		
		foreach(array_values($this->request->getData("fullSchedule")) as $scheduleKey => $scheduleValue)
		{
			foreach($scheduleValue["start_time"] as $key => $value)
			{
				if(isset($finalArray[$scheduleKey])) {
				$time[$scheduleKey][] = array("day"=>$finalArray[$scheduleKey], "start_time"=>($value=="00:00" || $value=="") ? "12:00" : $clockArray[$value], "start_meridiem"=>$scheduleValue["start_meridiem"][$key], "end_time"=>($scheduleValue["end_time"][$key]=="00:00" || $scheduleValue["end_time"][$key]=="") ? "12:00" : $clockArray[$scheduleValue["end_time"][$key]], "end_meridiem"=>$scheduleValue["end_meridiem"][$key], "duration_time"=>$scheduleValue["duration_time"][$key], "duration_min"=>$scheduleValue["duration_min"][$key]);
				}
			}
		}
		
		foreach($this->request->getData("passing_year") as $key => $value)
		{
			$qualification[] = array("university"=>$this->request->getData("university")[$key], "degree"=>$this->request->getData("degree")[$key], "passing_year"=>$value);
		}
		
		foreach($this->request->getData("phone") as $key => $value)
		{
			$phone[] = array("phone_code"=>$this->request->getData("phone_code")[$key], "phone"=>$value);
		}
		
		if(!empty($this->request->getData("dob"))) {
		$dateDOB = str_replace('/', '-', $this->request->getData("dob"));
		$explode = explode('-',$dateDOB);
		$dateDOB = $explode[2]."-".$explode[1]."-".$explode[0];
		}
		else {
		$dateDOB = date("Y-m-d");
		}
		
		$data["id"] = $this->request->getData("id") ? $this->request->getData("id") : "";
		$data["clinic_id"] = $this->request->getSession()->read('clinic_id') ? $this->request->getSession()->read('clinic_id') : 0;
		$data["users_id"] = $usersSaveData->id;
		$data["title"] = $this->request->getData("title") ? $this->request->getData("title") : "";
		$data["first_name"] = $this->request->getData("first_name") ? $this->request->getData("first_name") : "";
		$data["middle_name"] = $this->request->getData("middle_name") ? $this->request->getData("middle_name") : "";
		$data["last_name"] = $this->request->getData("last_name") ? $this->request->getData("last_name") : "";
		$data["gender"] = $this->request->getData("gender") ? $this->request->getData("gender") : "";
		$data["dob"] = $dateDOB ? $dateDOB : "";
		$data["email"] = $this->request->getData("email") ? json_encode($this->request->getData("email")) : "";
		$data["phone"] = isset($phone) && !empty($phone) ? json_encode($phone) : "";
		$data["speciality"] = $this->request->getData("speciality") ? $this->request->getData("speciality") : "";
		$data["type"] = $this->request->getData("type") ? $this->request->getData("type") : "";
		$data["registration_number"] = $this->request->getData("registration_number") ? $this->request->getData("registration_number") : "";
		$data["registration_authority"] = $this->request->getData("registration_authority") ? $this->request->getData("registration_authority") : "";
		$data["registration_state"] = $this->request->getData("registration_state") ? $this->request->getData("registration_state") : "";
		$data["qualification"] = isset($qualification) && !empty($qualification) ? json_encode($qualification) : "";
		$data["timing"] = isset($time) && !empty($time) ? json_encode($time) : "";
		$data["affiliation"] = $this->request->getData("affiliation") ? json_encode($this->request->getData("affiliation")) : "";
		$data["is_active"] = 1;
		
		if($this->request->getData("password") && !empty($this->request->getData("password")) && empty($this->request->getData("id")))
		{
			$data["password"] = hash('sha512',$this->request->getData("password"));
		}
		
		if($this->request->getData("image")["name"] && !empty($this->request->getData("image")["name"]))
		{
			$imageName = $this->request->getData("image")["name"] ? date("Y-m-d_H-i-s").$this->request->getData("image")["name"] : "";
			$tmpName = $this->request->getData("image")["tmp_name"] ? $this->request->getData("image")["tmp_name"] : "";
			
			move_uploaded_file($tmpName, $path . $imageName);
			
			$data["image"] = $imageName;
		}
		else
		{
			$data["image"] = $this->request->getData("oldImage");
		}
		
		$save = $doctorTable->newEntity($data);
		$saveData = $doctorTable->save($save);
		
		if($saveData)
		{
			if(isset($time) && !empty($time))
			{
				$doctorTiming->deleteAll(['doctor_id IN' => $saveData->id]);
				$timeData = array();
				foreach($time as $timeKey => $timeValue)
				{
					foreach($timeValue as $key => $value)
					{
						$timeData["doctor_id"] = $saveData->id;
						$timeData["day"] = $value["day"];
						$timeData["start_time"] = $value["start_time"]=="00:00" ? "12:00" : $value["start_time"];
						$timeData["start_meridiem"] = $value["start_meridiem"];
						$timeData["end_time"] = $value["end_time"]=="00:00" ? "12:00" : $value["end_time"];
						$timeData["end_meridiem"] = $value["end_meridiem"];
						$timeData["duration_time"] = $value["duration_time"];
						$timeData["duration_min"] = $value["duration_min"];

						$saveTime = $doctorTiming->newEntity($timeData);
						$saveTimeData = $doctorTiming->save($saveTime);
					}
				}
			}
			
			echo $this->redirect(["controller"=>"Doctor", "action"=>"doctorprofile",base64_encode($saveData->id)]);
			
			if(empty($data["id"]) && !empty($usersData["email"])) {
			
			$password = $this->request->getData("first_name") ? $this->request->getData("first_name") : $usersData["password"];
			
				$email = new Email('default');
				$email->setFrom(['sahil@unikove.com' => 'Unikove']);		
				//$email->setTo('sahilranjan05@gmail.com');
				$email->setTo($usersData["email"]);
				$email->setSubject('DocPharmrx - Password');
				$email->send("Hi,
Your Password is - ".$password.".
Thanks");
			}
		}
	}
	
	function doctorprofile($id)
	{
		$doctorTable = TableRegistry::get('doctor_details');
		$doctorTiming = TableRegistry::get('doctor_timings');
		
		$data = $doctorTable->find()
							  ->select()
							  ->where(["id"=>base64_decode($id)])
							   ->enableHydration(false)
							  ->first();
		//echo "<pre>";print_r($data);die;
		$this->set(compact("data"));
	}
	
	function changepassword()
	{
		$this->autoRender = false;
		$this->layout = false;
		
		$doctorTable = TableRegistry::get('doctor_details');
		
		$id = $this->request->getData("id");
		$oldPassword = hash('sha512',$this->request->getData("oldPassword"));
		$newPassword = hash('sha512',$this->request->getData("newPassword"));
		
		$data = $doctorTable->find()
							  ->select()
							  ->where(["id"=>$id, "password"=>$oldPassword])
							   ->enableHydration(false)
							  ->first();
		if(empty($data))
		{
			echo "Wrong Password";
		}
		else
		{
			$doctorTable->updateAll(['password' => $newPassword], ['id' => $id]);
			echo "Password Changed";
		}
	}
	
	function checkemail()
	{
		$this->autoRender = false;
		$this->layout = false;
		
		$usersTable = TableRegistry::get('users');
		
		$data = $usersTable->find()
						   ->select()
						   ->where(["email"=>$this->request->getData("emailValue"), "clinic_id"=>$this->request->getData("clinicID")])
						   ->enableHydration(false)
						   ->first();
		if(!empty($data))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	
	function activateStatus()
	{
		$this->autoRender = false;
		$this->layout = false;
		
		$doctorTable = TableRegistry::get('doctor_details');
		
		if($this->request->getData("status")==1)
		{
			$doctorTable->updateAll(['is_active' => 0], ['id' => $this->request->getData("id")]);
		}
		else
		{
			$doctorTable->updateAll(['is_active' => 1], ['id' => $this->request->getData("id")]);
		}
	}
	
	function setDoctorSession()
	{
		$this->autoRender = false;
		$this->layout = false;
		
		$_SESSION["doctorID"] = $this->request->getData("id");
	}
}

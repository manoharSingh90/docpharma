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

class AppointmentController extends AppController
{
	public function initialize()
    {
        parent::initialize();		
		$this->loadComponent('Emailer');
	}
	
	function index()
	{
		$role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
		$users_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : ""; 
	
		if(!$users_id)
		{
			$this->redirect(['controller'=>'Login','action'=>'index']);
		}
		
		$doctorTable = TableRegistry::get('doctor_details');
		$patientTable = TableRegistry::get('patient_details');
		
		if($this->request->getSession()->read('role_id')==1) {
		$doctorData = $doctorTable->find()
						  ->select(["id","first_name","middle_name","last_name"])
						  ->where(["clinic_id"=>$this->request->getSession()->read('clinic_id'),"is_active"=>1])
						  ->enableHydration(false)
						  ->toArray();
		}
		else {
		$doctorData = $doctorTable->find()
						  ->select(["id","first_name","middle_name","last_name"])
						  ->where(["users_id"=>$this->request->getSession()->read('users_id'),"is_active"=>1])
						  ->enableHydration(false)
						  ->toArray();
		}

		$patientData = $patientTable->find()
						  ->select(["id","fname","mname","lname"])
						  ->where(["clinic_id"=>$this->request->getSession()->read('clinic_id')])
						  ->order(['id'=>'DESC'])
						  ->enableHydration(false)
						  ->toArray();
		//echo "<pre>";print_r($patientData);die;
		$this->set(compact("doctorData","patientData"));
	}
	
	function save()
	{
		$role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
		$users_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : "";
		
		$appointmentTable = TableRegistry::get('appointment_details');
		
		$data = array();
		
		if($this->request->getData("comments"))
		{
			foreach($this->request->getData("comments") as $key => $value)
			{
				if(!empty($value))
				{
					$data["comments"] = $value;
				}
			}
		}
		
		$data["id"] = $this->request->getData("id") ? $this->request->getData("id") : "";
		$data["clinic_id"] = $this->request->getSession()->read('clinic_id') ? $this->request->getSession()->read('clinic_id') : "";
		$data["doctor_id"] = $this->request->getData("doctor_id") ? $this->request->getData("doctor_id") : "";
		$data["patient_id"] = $this->request->getData("patient_id") ? $this->request->getData("patient_id") : "";
		$data["appointment_date"] = $this->request->getData("appointment_date") ? $this->request->getData("appointment_date") : "";
		$data["appointment_day"] = $this->request->getData("appointment_date") ? date('D', strtotime($this->request->getData("appointment_date"))) : "";
		$data["appointment_time"] = $this->request->getData("appointment_time") ? $this->request->getData("appointment_time") : "";
		
		$data["bulkcancellation_status"] = 1;
		$data["is_active"] = 1;
		
		 $data["appointment_date1"] = $this->request->getData("appointment_date") ? $this->request->getData("appointment_date") : "";
		$date1 = strtotime($data['appointment_date1']);
		$data["appointment_date1"] = date('Y-m-d',$date1);
		
		$data["appointment_time1"] = $this->request->getData("appointment_time") ? $this->request->getData("appointment_time") : "";
		$time1 = strtotime($data['appointment_time1']);
		$data["appointment_time1"] = date('H:i',$time1);
		//echo '<pre>'; print_r($data); die;
		
		$save = $appointmentTable->newEntity($data);
		$saveData = $appointmentTable->save($save);
		
		if(!empty($data["id"]))
		{
			//echo $this->redirect(["controller"=>"Appointment", "action"=>"reschedule_appointment",base64_encode($data["id"])]);
			//echo $this->redirect(["controller"=>"Appointment", "action"=>"reschedule_appointment",$data["id"]]);
			echo $this->redirect(["controller"=>"Appointment", "action"=>"listing"]);
		}
		else if($saveData)
		{
			echo $this->redirect(["controller"=>"Appointment", "action"=>"listing"]);
		}
	}
	
	function listing()
	{
		$role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
		$users_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : ""; 
	
		if(!$role_id)
		{
			$this->redirect(['controller'=>'Login','action'=>'index']);
		}
		
		$doctorTable = TableRegistry::get('doctor_details');
		$appointmentTable = TableRegistry::get('appointment_details');
		
		$appointmentTable->belongsTo("doctor_details",["foreignKey"=>"doctor_id"]);
		$appointmentTable->belongsTo("patient_details",["foreignKey"=>"patient_id"]);
		
		if($this->request->getSession()->read('role_id')==1) {
		$doctorData = $doctorTable->find()
						  ->select(["id","first_name","middle_name","last_name"])
						  ->where(["clinic_id"=>$this->request->getSession()->read('clinic_id'),"is_active"=>1])
						  ->enableHydration(false)
						  ->toArray();
		}
		else {
		$doctorData = $doctorTable->find()
						  ->select(["id","first_name","middle_name","last_name"])
						  ->where(["users_id"=>$this->request->getSession()->read('users_id'),"is_active"=>1])
						  ->enableHydration(false)
						  ->toArray();
		}
		
		if($this->request->getSession()->read('role_id')==1) {
		$appointmentData = $appointmentTable->find()
						  ->select()
						  ->where(["appointment_details.clinic_id"=>$this->request->getSession()->read('clinic_id'),"appointment_details.is_active"=>1,"appointment_details.bulkcancellation_status"=>1,"appointment_details.appointment_date"=>date("d M Y")])
						  ->contain(["doctor_details","patient_details"])
						  ->enableHydration(false)
						  ->toArray();
		}
		else {
		$appointmentData = $appointmentTable->find()
						  ->select()
						  ->where(["appointment_details.doctor_id"=>$doctorData[0]["id"],"appointment_details.is_active"=>1,"appointment_details.bulkcancellation_status"=>1,"appointment_details.appointment_date"=>date("d M Y")])
						  ->contain(["doctor_details","patient_details"])
						  ->enableHydration(false)
						  ->toArray();
		}
		//echo "<pre>";print_r($appointmentData);die;
		$this->set(compact("doctorData","appointmentData"));
	}
	
	function getListingData()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$appointmentTable = TableRegistry::get('appointment_details');
		
		$appointmentTable->belongsTo("doctor_details",["foreignKey"=>"doctor_id"]);
		$appointmentTable->belongsTo("patient_details",["foreignKey"=>"patient_id"]);

		$_SESSION["doctorID"] = "";
		
		$fromDate = date_format(date_create(($this->request->getData("fromDate"))),"Y-m-d");
		$toDate = date_format(date_create(($this->request->getData("toDate"))),"Y-m-d");
		
		if($this->request->getData("id")!=0) {
		$appointmentData = $appointmentTable->find()
						  ->select()
						  ->where(["appointment_details.clinic_id"=>$this->request->getSession()->read('clinic_id'),"appointment_details.is_active"=>1,"appointment_details.bulkcancellation_status"=>1,"doctor_id"=>$this->request->getData("id"),array("appointment_date1 >=" =>$fromDate,"appointment_date1 <=" =>$toDate)])
						  ->contain(["doctor_details","patient_details"])
						  ->order(['appointment_date1'=>'ASC'])
						  ->enableHydration(false)
						  ->toArray();
		}
		else {
		$appointmentData = $appointmentTable->find()
						  ->select()
						  ->where(["appointment_details.clinic_id"=>$this->request->getSession()->read('clinic_id'),"appointment_details.is_active"=>1,"appointment_details.bulkcancellation_status"=>1,array("appointment_date1 >=" =>$fromDate,"appointment_date1 <=" =>$toDate)])
						  ->contain(["doctor_details","patient_details"])
						  ->order(['appointment_date1'=>'ASC'])
						  ->enableHydration(false)
						  ->toArray();
		}
		
		$queueData = $this->request->getData("queueData") ? $this->request->getData("queueData") : "";
		$paymentDone = $this->request->getData("paymentDone") ? $this->request->getData("paymentDone") : "";
						  
		$this->set(compact("appointmentData","queueData","paymentDone"));
		
		$this->render('/Element/Appointment/listing');
	}
	
	public function removeStatus()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$appointmentTable = TableRegistry::get('appointment_details');
		
		$appointmentTable->updateAll(['is_active' => 0 , 'cancel_message' => $this->request->getData("message")], ['id' => $this->request->getData("id")]);
	}
	
	public function getPatitentData()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$_SESSION["patientID"] = "";

		$patientTable = TableRegistry::get('patient_details');

		$patientData = $patientTable->find()
						  ->select(["dob","gender","m_number"])
						  ->where(["id"=>$this->request->getData("id")])
						  ->enableHydration(false)
						  ->first();
		
		echo json_encode($patientData);
	}

	public function getSlotData()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$appointmentTable = TableRegistry::get('appointment_details');
		$doctorTiming = TableRegistry::get('doctor_timings');
		$blackoutTable = TableRegistry::get('blackout_details');
		
		$appointmentTable->belongsTo("patient_details",["foreignKey"=>"patient_id"]);
		
		$currentDate = $this->request->getData("currentDate");
		
		if(!empty($this->request->getData("id"))) {
		$doctorTiming = $doctorTiming->find()
						  ->select()
						  ->where(["doctor_id"=>$this->request->getData("id"), 'FIND_IN_SET(\''. $this->request->getData("getDay") .'\',day)'])
						  ->enableHydration(false)
						  ->toArray();
						  
		$savedTiming = $appointmentTable->find()
						  ->select()
						  ->where(["doctor_id"=>$this->request->getData("id"), "appointment_day"=>$this->request->getData("getDay")])
						  ->contain(["patient_details"])
						  ->enableHydration(false)
						  ->toArray();
		
		
		//CHECK BLACKOUT DATES
		$blackoutData = $blackoutTable->find()->select()->where(["doctor_id"=>$this->request->getData("id")])->enableHydration(false)->toArray();
		$minStartDate = $blackoutTable->find()->select(["blackout_startdate"])->where(["doctor_id"=>$this->request->getData("id")])->enableHydration(false)->min('blackout_startdate');
		$maxEndDate = $blackoutTable->find()->select(["blackout_enddate"])->where(["doctor_id"=>$this->request->getData("id")])->enableHydration(false)->max('blackout_enddate');
		
		$checkBlackout = array();
		if(!empty($minStartDate) && !empty($maxEndDate) && !empty($blackoutData))
		{
			
			$minStartDate = strtotime(date("d M Y"))>=strtotime(date_format($minStartDate["blackout_startdate"],"d M Y")) ? strtotime(date("d M Y")) : strtotime(date_format($minStartDate["blackout_startdate"],"d M Y"));
		
			$maxEndDate = strtotime(date("d M Y"))<=strtotime(date_format($maxEndDate["blackout_enddate"],"d M Y")) ? strtotime(date_format($maxEndDate["blackout_enddate"],"d M Y")) : "";
			
			for($i=$minStartDate; $i<=$maxEndDate; $i+=86400)
			{
				foreach($blackoutData as $key => $value)
				{
					if(strtotime(date_format($value["blackout_startdate"],"d M Y"))<=$i && $i<=strtotime(date_format($value["blackout_enddate"],"d M Y")))
					{
						$checkBlackout[date("d M Y", $i)]["blackout_starttime"] = date_format($value["blackout_starttime"],"H:i");
						$checkBlackout[date("d M Y", $i)]["blackout_endtime"] = date_format($value["blackout_endtime"],"H:i");
					}
				}
			}
		}
		//CHECK BLACKOUT DATES
		
		$this->set(compact("doctorTiming","savedTiming","currentDate","checkBlackout"));
		}
		
		$this->render('/Element/Appointment/timings');
	}
	
	public function getDoctorTimings()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$doctorDetailsTable = TableRegistry::get('doctor_details');
		
		$doctorDetailsData = $doctorDetailsTable->find()
						  ->select(["timing"])
						  ->where(["id"=>$this->request->getData("id")])
						  ->enableHydration(false)
						  ->first();
		
		$timingsData = array();
		if(!empty($doctorDetailsData))
		{
			$timeData = json_decode($doctorDetailsData["timing"],true);
			
			foreach($timeData as $key => $value)
			{
				foreach($value as $timeKey => $timeValue)
				{
					$timingsData[] = '<div class="customformwrap" style="margin-bottom:5px;">';
					if($timeKey==0)
					{
						$timingsData[] = '<label class="customLabel">'.str_replace(",",", ",$timeValue["day"]).'</label>';
					}
					$timingsData[] = '<span>'.$timeValue["start_time"]." ".$timeValue["start_meridiem"]." - ".$timeValue["end_time"]." ".$timeValue["end_meridiem"].'</span></div>';
				}
			}
		}
		$timingsData = implode("",$timingsData);
		echo $timingsData;
	}
	
	public function appointmentdetails($id)
	{
		$role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
		$users_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : "";
		
		$conn = ConnectionManager::get('default');
		
		$appointmentTable = TableRegistry::get('appointment_details');
		$doctorNotesTable = TableRegistry::get('doctor_notes');
		
		$appointmentTable->belongsTo("doctor_details",["foreignKey"=>"doctor_id"]);
		$appointmentTable->belongsTo("patient_details",["foreignKey"=>"patient_id"]);
		
		$appointmentDetails = $appointmentTable->find()
						  ->select()
						  //->where(["appointment_details.id"=>base64_decode($id)])
						  ->where(["appointment_details.id"=>$id])
						  ->contain(["doctor_details","patient_details"])
						  ->enableHydration(false)
						  ->first();
						  
		if($appointmentDetails["patient_detail"]["id"])
		{				  
		$patientVisit = $appointmentTable->find()
						  ->select(["appointment_date"])
						  ->where(["patient_id"=>$appointmentDetails["patient_detail"]["id"]])
						  ->contain(["doctor_details","patient_details"])
						  ->enableHydration(false)
						  ->toArray();
		}
		
		$doctorNotesData = $doctorNotesTable->find()
						  ->select()
						  ->where(["doctor_id"=>$appointmentDetails["doctor_detail"]["id"], "patient_id"=>$appointmentDetails["patient_detail"]["id"]])
						  ->enableHydration(false)
						  ->toArray();
		
		$previousQuery = $conn->execute('SELECT doctor_visit.patient_id, doctor_visit.appointment_id, doctor_visit.observation, doctor_visit.patient_notes, doctor_visit.visit_date, PP.id as ppID, PP.product_name, PP.product_type, PP.dosage_qty, PP.dosage_frequency, PP.duration_no, PP.duration_frequency, PP.total_qty, PP.notes, PT.day_of_week, PT.morning, PT.midday, PT.afternoon, PT.evening, PT.dinner, PT.morning_quantity, PT.afternoon_quantity, PT.evening_quantity, PT.dinner_quantity, PT.custom_times, PT.abbreviation, PT.abbreviation_meaning FROM patient_prescriptions AS PP INNER JOIN prescription_timings AS PT ON PP.id = PT.prescription_id INNER JOIN doctor_visit ON doctor_visit.id = PP.doctor_visit_id WHERE doctor_visit.patient_id='.$appointmentDetails['patient_id'].' ORDER BY PP.id DESC');
		$previousData = $previousQuery ->fetchAll('assoc');
		$checkPreviousArray = array();
		if(isset($previousData) && !empty($previousData)) {
		foreach($previousData as $key => $value) {
		if(in_array($value["ppID"], $checkPreviousArray))
		{
			unset($previousData[$key]);
		}
		$checkPreviousArray[] = $value["ppID"];
		} }
		//echo "<pre>"; print_r($previousData);die;
		
		$allReports = $conn->execute('SELECT test_master.test_name, patient_test_reports.test_id, patient_test_reports.test_recommended, patient_test_reports.recommended_date, patient_test_reports.test_date, patient_test_reports.test_notes, patient_test_reports.test_report_filename FROM test_master INNER JOIN patient_test_reports ON test_master.id = patient_test_reports.test_id INNER JOIN doctor_visit ON doctor_visit.id=patient_test_reports.doctor_visit_id WHERE doctor_visit.patient_id='.$appointmentDetails['patient_id'].' ');
		$allReportsData = $allReports ->fetchAll('assoc');
						  
		$this->set(compact("appointmentDetails","patientVisit","previousData","doctorNotesData","allReportsData"));
	}
	
	public function rescheduleappointment($id)
	{
		$role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
		$users_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : "";
		
		$appointmentTable = TableRegistry::get('appointment_details');
		$doctorTiming = TableRegistry::get('doctor_timings');
		
		$appointmentTable->belongsTo("doctor_details",["foreignKey"=>"doctor_id"]);
		$appointmentTable->belongsTo("patient_details",["foreignKey"=>"patient_id"]);
		
		$rescheduleData = $appointmentTable->find()
						  ->select()
						  //->where(["appointment_details.id"=>base64_decode($id)])
						  ->where(["appointment_details.id"=>$id])
						  ->contain(["doctor_details","patient_details"])
						  ->enableHydration(false)
						  ->first();
		
		$currentDate = date('d M Y');

		$doctorTiming = $doctorTiming->find()
						  ->select()
						  ->where(["doctor_id"=>$rescheduleData["doctor_id"], 'FIND_IN_SET(\''. date("D",strtotime(date('d M Y'))) .'\',day)'])
						  ->enableHydration(false)
						  ->toArray();
						  
		$savedTiming = $appointmentTable->find()
						  ->select()
						  ->where(["doctor_id"=>$rescheduleData["doctor_id"], "appointment_day"=>date("D",strtotime(date('d M Y')))])
						  ->contain(["patient_details"])
						  ->enableHydration(false)
						  ->toArray();
		
		$this->set(compact("rescheduleData","doctorTiming","savedTiming","currentDate"));
	}
	
	public function doctorconsultant($id)
	{
		$this->request->getSession()->write('role_id',2);

		$role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
		$users_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : "";
		
		if(!$users_id)
		{
			$this->redirect(['controller'=>'Login','action'=>'index']);
		}
		
		$conn = ConnectionManager::get('default');
		
		$testMasterTable = TableRegistry::get('test_master');
		$appointmentTable = TableRegistry::get('appointment_details');
		$doctorNotesTable = TableRegistry::get('doctor_notes');
		$doctorVisitTable = TableRegistry::get('doctor_visit');
		
		$appointmentTable->belongsTo("doctor_details",["foreignKey"=>"doctor_id"]);
		$appointmentTable->belongsTo("patient_details",["foreignKey"=>"patient_id"]);
		
		$testMasterData = $testMasterTable->find()
							->select(["id","test_name"])
							->enableHydration(false)
							->toArray();
		
		$appointmentDetails = $appointmentTable->find()
						  ->select()
						  //->where(["appointment_details.id"=>base64_decode($id)])
						  ->where(["appointment_details.id"=>$id])
						  ->contain(["doctor_details","patient_details"])
						  ->enableHydration(false)
						  ->first();
						  
		$doctorNotesData = $doctorNotesTable->find()
						  ->select()
						  ->where(["doctor_id"=>$appointmentDetails["doctor_detail"]["id"], "patient_id"=>$appointmentDetails["patient_detail"]["id"]])
						  ->enableHydration(false)
						  ->toArray();

		$doctorVisitData = $doctorVisitTable->find()
						  ->select()
						  ->where(["appointment_id"=>$id])
						  ->enableHydration(false)
						  ->first();
		
		$prescriptionQuery = $conn->execute('SELECT doctor_details.first_name as doctor_Fname, doctor_details.middle_name as doctor_Mname, doctor_details.last_name as doctor_Lname, patient_details.title as patient_title, patient_details.fname as patient_Fname, patient_details.mname as patient_Mname, patient_details.lname as patient_Lname, patient_details.dob as patient_dob, patient_details.address as patient_address, patient_details.country as patient_country, patient_details.state as patient_state, doctor_visit.id as dvID, doctor_visit.observation, doctor_visit.patient_notes, doctor_visit.visit_date, PP.id as ppID, PP.product_name, PP.product_guid, PP.product_type, PP.dosage_qty, PP.duration_no, PP.duration_frequency, PP.total_qty, PP.notes, PP.email_status, PT.id as ptID, PT.day_of_week, PT.morning, PT.midday, PT.afternoon, PT.evening, PT.dinner, PT.morning_quantity, PT.afternoon_quantity, PT.evening_quantity, PT.dinner_quantity, PT.custom_times, PT.abbreviation, PT.abbreviation_meaning FROM patient_prescriptions AS PP INNER JOIN prescription_timings AS PT ON PP.id = PT.prescription_id RIGHT JOIN doctor_visit ON doctor_visit.id = PP.doctor_visit_id INNER JOIN doctor_details ON doctor_details.id = doctor_visit.doctor_id INNER JOIN patient_details ON patient_details.id = doctor_visit.patient_id WHERE doctor_visit.appointment_id='.$id.' ORDER BY PP.id DESC');
		
		$prescriptionData = $prescriptionQuery ->fetchAll('assoc');
		$checkArray = array();
		if(isset($prescriptionData) && !empty($prescriptionData)) {
		foreach($prescriptionData as $key => $value) {
		if(in_array($value["ppID"], $checkArray))
		{
			unset($prescriptionData[$key]);
		}
		$checkArray[] = $value["ppID"];
		} }
		//echo "<pre>"; print_r($prescriptionData);die;
		
		if($prescriptionData[0]['dvID']) {
		$testReportQuery = $conn->execute('SELECT test_master.test_name, patient_test_reports.test_id, patient_test_reports.test_recommended, patient_test_reports.recommended_date, patient_test_reports.test_date, patient_test_reports.test_notes, patient_test_reports.test_report_filename FROM test_master INNER JOIN patient_test_reports ON test_master.id = patient_test_reports.test_id WHERE patient_test_reports.doctor_visit_id='.$prescriptionData[0]['dvID'].' ');
		$testReportData = $testReportQuery ->fetchAll('assoc');
		}
		
		$medicationQuery = $conn->execute('SELECT PP.id, PP.product_name, PP.product_type, PP.dosage_qty, PP.duration_no, PP.duration_frequency, PP.total_qty, PT.day_of_week, PT.morning, PT.midday, PT.afternoon, PT.evening, PT.dinner, PT.morning_quantity, PT.afternoon_quantity, PT.evening_quantity, PT.dinner_quantity, PT.custom_times, PT.abbreviation, PT.abbreviation_meaning FROM patient_prescriptions AS PP INNER JOIN prescription_timings AS PT ON PP.id = PT.prescription_id INNER JOIN doctor_visit ON doctor_visit.id = PP.doctor_visit_id WHERE doctor_visit.patient_id='.$appointmentDetails['patient_id'].' ');
		$medicationData = $medicationQuery ->fetchAll('assoc');
		
		$previousQuery = $conn->execute('SELECT doctor_visit.patient_id, doctor_visit.appointment_id, doctor_visit.observation, doctor_visit.patient_notes, doctor_visit.visit_date, PP.id as ppID, PP.product_name, PP.product_type, PP.dosage_qty, PP.dosage_frequency, PP.duration_no, PP.duration_frequency, PP.total_qty, PP.notes, PT.day_of_week, PT.morning, PT.midday, PT.afternoon, PT.evening, PT.dinner, PT.morning_quantity, PT.afternoon_quantity, PT.evening_quantity, PT.dinner_quantity, PT.custom_times, PT.abbreviation, PT.abbreviation_meaning FROM patient_prescriptions AS PP INNER JOIN prescription_timings AS PT ON PP.id = PT.prescription_id RIGHT JOIN doctor_visit ON doctor_visit.id = PP.doctor_visit_id WHERE doctor_visit.patient_id='.$appointmentDetails['patient_id'].' ORDER BY PP.id DESC');
		$previousData = $previousQuery ->fetchAll('assoc');
		$checkPreviousArray = array();
		if(isset($previousData) && !empty($previousData)) {
		foreach($previousData as $key => $value) {
		if(in_array($value["ppID"], $checkPreviousArray))
		{
			unset($previousData[$key]);
		}
		$checkPreviousArray[] = $value["ppID"];
		} }
		//echo "<pre>"; print_r($previousData);die;
		
		$allReports = $conn->execute('SELECT test_master.test_name, doctor_visit.visit_date, patient_test_reports.test_id, patient_test_reports.test_recommended, patient_test_reports.recommended_date, patient_test_reports.test_date, patient_test_reports.test_notes, patient_test_reports.test_report_filename FROM test_master INNER JOIN patient_test_reports ON test_master.id = patient_test_reports.test_id INNER JOIN doctor_visit ON doctor_visit.id=patient_test_reports.doctor_visit_id WHERE doctor_visit.patient_id='.$appointmentDetails['patient_id'].' ');
		$allReportsData = $allReports ->fetchAll('assoc');
		//echo "<pre>"; print_r($allReportsData);die;
		
		$this->set(compact("testMasterData","appointmentDetails","prescriptionData","medicationData","previousData","doctorNotesData","doctorVisitData","testReportData","allReportsData"));
	}
	
	public function medicationdetails()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$conn = ConnectionManager::get('default');
		$medicationQuery = $conn->execute('SELECT PP.id, PP.product_guid, PP.product_name, PP.product_type, PP.product_search_by, PP.dosage_qty, PP.dosage_frequency, PP.duration_no, PP.duration_frequency, PP.total_qty, PP.notes, PT.day_of_week, PT.morning, PT.midday, PT.afternoon, PT.evening, PT.dinner, PT.morning_quantity, PT.afternoon_quantity, PT.evening_quantity, PT.dinner_quantity, PT.custom_times, PT.abbreviation, PT.abbreviation_meaning FROM patient_prescriptions AS PP INNER JOIN prescription_timings AS PT ON PP.id = PT.prescription_id WHERE PP.id='.$this->request->getData("id").' ');
		$medicationData = $medicationQuery ->fetch('assoc');
		$this->set(compact("medicationData"));
		
		$this->render('/Element/Appointment/medication_data');
	}
	
	public function saveprescription()
	{
		$path = WWW_ROOT.'img/images/prescription/';
		$dir = new Folder($path, true, 0755);
		//echo "<pre>"; print_r($this->request->getData());die;
		$doctorVisitTable = TableRegistry::get('doctor_visit');
		$reportsTable = TableRegistry::get('patient_test_reports');
		$patientPrescriptionsTable = TableRegistry::get('patient_prescriptions');
		$prescriptionTimingsTable = TableRegistry::get('prescription_timings');
		$abbreviationTable = TableRegistry::get('abbreviation_master');
		
		//SAVE DATA IN 'doctor_visit' TABLE
		$dvData["id"] = $this->request->getData("dvID") ? $this->request->getData("dvID") : "";
		$dvData["doctor_id"] = $this->request->getData("doctor_id") ? $this->request->getData("doctor_id") : "";
		$dvData["patient_id"] = $this->request->getData("patient_id") ? $this->request->getData("patient_id") : "";
		$dvData["appointment_id"] = $this->request->getData("appointment_id") ? $this->request->getData("appointment_id") : "";
		$dvData["observation"] = $this->request->getData("observation") ? $this->request->getData("observation") : "";
		$dvData["patient_notes"] = $this->request->getData("patient_notes") ? $this->request->getData("patient_notes") : "";
		$dvData["visit_date"] = date("d M Y");
		
		$dvSave = $doctorVisitTable->newEntity($dvData);
		$dvSaveData = $doctorVisitTable->save($dvSave);
		//SAVE DATA IN 'doctor_visit' TABLE
		
		
		//SAVE DATA IN 'patient_test_reports' TABLE
		$reportsTable->deleteAll(['doctor_visit_id IN' => $this->request->getData("dvID")]);
		
		if($this->request->getData("report_test_id"))
		{
			foreach($this->request->getData("report_test_id") as $key => $value)
			{
				$rpData["doctor_visit_id"] = $dvSaveData->id;
				$rpData["test_id"] = $value;
				$rpData["test_recommended"] = 0;
				$rpData["test_date"] = $this->request->getData("test_date") ? $this->request->getData("test_date") : "";
				$rpData["test_notes"] = $this->request->getData("test_notes") ? $this->request->getData("test_notes") : "";
				
				if($this->request->getData("test_report_filename")["name"] && !empty($this->request->getData("test_report_filename")["name"]))
				{
					$imageName = $this->request->getData("test_report_filename")["name"] ? date("Y-m-d_H-i-s,").$this->request->getData("test_report_filename")["name"] : "";
					$tmpName = $this->request->getData("test_report_filename")["tmp_name"] ? $this->request->getData("test_report_filename")["tmp_name"] : "";
					
					move_uploaded_file($tmpName, $path . $imageName);
					
					$rpData["test_report_filename"] = $imageName;
				}
				else
				{
					$rpData["test_report_filename"] = $this->request->getData("oldImage");
				}
				
				$rpSave = $reportsTable->newEntity($rpData);
				$rpSaveData = $reportsTable->save($rpSave);
			}
		}
		
		if($this->request->getData("test_id"))
		{
			foreach($this->request->getData("test_id") as $key => $value)
			{
				$rpData1["doctor_visit_id"] = $dvSaveData->id;
				$rpData1["test_id"] = $value;
				$rpData1["test_recommended"] = 1;
				$rpData1["recommended_date"] = date("d M Y");
				
				$rpSave1 = $reportsTable->newEntity($rpData1);
				$rpSaveData1 = $reportsTable->save($rpSave1);
			}
		}
		//SAVE DATA IN 'patient_test_reports' TABLE
		
		
		if(!empty($this->request->getData("product_name"))) {
		//SAVE DATA IN 'patient_prescriptions' TABLE
		$explodeName = $this->request->getData("product_name") && !empty($this->request->getData("product_name")) ? explode("_",$this->request->getData("product_name")) : "";
		
		$ppData["id"] = $this->request->getData("ppID") ? $this->request->getData("ppID") : "";
		$ppData["doctor_visit_id"] = $dvSaveData->id;
		$ppData["product_guid"] = isset($explodeName[0]) ? $explodeName[0] : "";
		$ppData["product_name"] = isset($explodeName[1]) ? $explodeName[1] : "";
		$ppData["product_type"] = $this->request->getData("product_type") && !empty($this->request->getData("product_type")) ? $this->request->getData("product_type") : "TAB";
		$ppData["product_search_by"] = $this->request->getData("product_search_by") && !empty($this->request->getData("product_search_by")) ? $this->request->getData("product_search_by") : 1;
		$ppData["dosage_qty"] = $this->request->getData("customCheck")!=1 && $this->request->getData("dosage_qty") ? $this->request->getData("dosage_qty") : "";
		
		//$ppData["dosage_frequency"] = $this->request->getData("customCheck")!=1 && $this->request->getData("dosage_frequency") ? $this->request->getData("dosage_frequency") : $this->request->getData("dosage_no_frequency");
		$ppData["dosage_frequency"] = $this->request->getData("customCheck")!=1 && $this->request->getData("dosage_frequency") ? $this->request->getData("dosage_frequency") : "";
		
		$ppData["duration_no"] = $this->request->getData("duration_no") ? $this->request->getData("duration_no") : "";
		
		//$ppData["duration_frequency"] = $this->request->getData("customCheck")!=1 && $this->request->getData("duration_frequency") ? $this->request->getData("duration_frequency") : $this->request->getData("duration_no_frequency");
		$ppData["duration_frequency"] = $this->request->getData("duration_frequency") ? $this->request->getData("duration_frequency") : "";
		
		$ppData["total_qty"] = $this->request->getData("total_qty") ? $this->request->getData("total_qty") : "";
		$ppData["notes"] = $this->request->getData("notes") ? $this->request->getData("notes") : "";
		$ppData["patient_prescription"] = $this->request->getData("patient_notes") ? $this->request->getData("patient_notes") : "";
		$ppData["email_status"] = $this->request->getData("ppID") && !empty($this->request->getData("ppID")) ? 1 : 0;
		
		$ppSave = $patientPrescriptionsTable->newEntity($ppData);
		$ppSaveData = $patientPrescriptionsTable->save($ppSave);
		//SAVE DATA IN 'patient_prescriptions' TABLE
		
		
		//SAVE DATA IN 'prescription_timings' TABLE
		foreach($this->request->getData("day_of_week") as $key => $value)
		{
			if(!empty($value))
			{
				$weekData[] = $value;
			}
		}
		
		
		if($this->request->getData("time")) {
		foreach($this->request->getData("time") as $key => $value)
		{
			//$customTimes[] = array("time"=>$value=="00:00" ? "12:00" : $value, "meridiem"=>$this->request->getData("meridiem")[$key], "meridiem_quantity"=>$this->request->getData("meridiem_quantity")[$key]);
			
			$customTimes[] = array("time"=>$value=="00:00" ? "12:00" : $value, "abbreviation"=>$this->request->getData("abbreviation")[$key], "abbreviation_meaning"=>$this->request->getData("abbreviation_meaning")[$key]);
		} }
		
		$ptData["id"] = $this->request->getData("ptID") ? $this->request->getData("ptID") : "";
		$ptData["doctor_visit_id"] = $ppSaveData->doctor_visit_id;
		$ptData["prescription_id"] = $ppSaveData->id;
		$ptData["day_of_week"] = isset($weekData) && $this->request->getData("customCheck")!=1 ? implode(",",$weekData) : "";
		$ptData["morning"] = $this->request->getData("customCheck")!=1 && $this->request->getData("morning") ? $this->request->getData("morning") : "";
		$ptData["midday"] = $this->request->getData("customCheck")!=1 && $this->request->getData("midday") ? $this->request->getData("midday") : "";
		$ptData["afternoon"] = $this->request->getData("customCheck")!=1 && $this->request->getData("afternoon") ? $this->request->getData("afternoon") : "";
		$ptData["evening"] = $this->request->getData("customCheck")!=1 && $this->request->getData("evening") ? $this->request->getData("evening") : "";
		$ptData["dinner"] = $this->request->getData("customCheck")!=1 && $this->request->getData("dinner") ? $this->request->getData("dinner") : "";
		$ptData["morning_quantity"] = $this->request->getData("customCheck")!=1 && $this->request->getData("morning_quantity") ? $this->request->getData("morning_quantity") : "";
		$ptData["afternoon_quantity"] = $this->request->getData("customCheck")!=1 && $this->request->getData("afternoon_quantity") ? $this->request->getData("afternoon_quantity") : "";
		$ptData["evening_quantity"] = $this->request->getData("customCheck")!=1 && $this->request->getData("evening_quantity") ? $this->request->getData("evening_quantity") : "";
		$ptData["dinner_quantity"] = $this->request->getData("customCheck")!=1 && $this->request->getData("dinner_quantity") ? $this->request->getData("dinner_quantity") : "";
		$ptData["custom_times"] = isset($customTimes) && !empty($customTimes) && $this->request->getData("customCheck")==1 ? json_encode($customTimes) : "";
		
		//$ptData["abbreviation"] = $this->request->getData("customCheck")==1 && $this->request->getData("abbreviation") ? $this->request->getData("abbreviation") : "";
		//$ptData["abbreviation_meaning"] = isset($abbreviationMeaning) && !empty($abbreviationMeaning) && $this->request->getData("customCheck")==1 ? implode(" ",$abbreviationMeaning) : "";
		
		$ptSave = $prescriptionTimingsTable->newEntity($ptData);
		$ptSaveData = $prescriptionTimingsTable->save($ptSave);
		//SAVE DATA IN 'prescription_timings' TABLE
		}
		
		$role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
		$users_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : "";
		
		echo $this->redirect(["controller"=>"Appointment", "action"=>"doctor_consultant",$dvSaveData->appointment_id]);
		
	}
	
	public function edit()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$testMasterTable = TableRegistry::get('test_master');
		
		$conn = ConnectionManager::get('default');
		$dvQuery = $conn->execute('SELECT doctor_visit.id as dvID, doctor_visit.doctor_id, doctor_visit.patient_id, doctor_visit.appointment_id, doctor_visit.observation, doctor_visit.patient_notes FROM doctor_visit WHERE doctor_visit.id='.$this->request->getData("id"));
		$dvData = $dvQuery ->fetch('assoc');
		
		$prescriptionQuery = $conn->execute('SELECT PP.id as ppID, PP.product_guid, PP.product_name, PP.product_type, PP.product_search_by, PP.dosage_qty, PP.dosage_frequency, PP.duration_no, PP.duration_frequency, PP.total_qty, PP.notes, PP.patient_prescription, PT.id as ptID, PT.day_of_week, PT.morning, PT.midday, PT.afternoon, PT.evening, PT.dinner, PT.morning_quantity, PT.afternoon_quantity, PT.evening_quantity, PT.dinner_quantity, PT.custom_times, PT.abbreviation, PT.abbreviation_meaning FROM patient_prescriptions AS PP INNER JOIN prescription_timings AS PT ON PP.id = PT.prescription_id WHERE PP.id='.$this->request->getData("ppID").' ORDER BY PP.id DESC');
		$editPrescriptionData = $prescriptionQuery ->fetch('assoc');
		
		$editPrescriptionData = array_merge($dvData,$editPrescriptionData);
		
		$testReportQuery = $conn->execute('SELECT test_master.test_name, patient_test_reports.test_id, patient_test_reports.test_recommended, patient_test_reports.recommended_date, patient_test_reports.test_date, patient_test_reports.test_notes, patient_test_reports.test_report_filename FROM test_master INNER JOIN patient_test_reports ON test_master.id = patient_test_reports.test_id WHERE patient_test_reports.doctor_visit_id='.$this->request->getData("id").' ');
		$testReportData = $testReportQuery ->fetchAll('assoc');
		
		//$previousQuery = $conn->execute('SELECT test_master.test_name, doctor_visit.observation, doctor_visit.patient_notes, patient_test_reports.test_date, patient_test_reports.test_notes, patient_test_reports.test_report_filename, PP.product_name, PP.dosage_qty, PP.dosage_frequency, PP.duration_no, PP.duration_frequency, PP.total_qty, PP.notes, PT.day_of_week, PT.morning, PT.midday, PT.afternoon, PT.evening, PT.dinner, PT.custom_times FROM patient_prescriptions AS PP INNER JOIN prescription_timings AS PT ON PP.id = PT.prescription_id INNER JOIN doctor_visit ON doctor_visit.id = PP.doctor_visit_id INNER JOIN patient_test_reports ON patient_test_reports.doctor_visit_id = doctor_visit.id LEFT JOIN test_master ON test_master.id = patient_test_reports.test_id WHERE doctor_visit.patient_id='.$editPrescriptionData['patient_id'].' ORDER BY PP.id DESC');
		//$previousData = $previousQuery ->fetchAll('assoc');
		
		$previousQuery = $conn->execute('SELECT doctor_visit.patient_id, doctor_visit.appointment_id, doctor_visit.observation, doctor_visit.patient_notes, doctor_visit.visit_date, PP.id as ppID, PP.product_name, PP.product_type, PP.dosage_qty, PP.dosage_frequency, PP.duration_no, PP.duration_frequency, PP.total_qty, PP.notes, PT.day_of_week, PT.morning, PT.midday, PT.afternoon, PT.evening, PT.dinner, PT.morning_quantity, PT.afternoon_quantity, PT.evening_quantity, PT.dinner_quantity, PT.custom_times FROM patient_prescriptions AS PP INNER JOIN prescription_timings AS PT ON PP.id = PT.prescription_id INNER JOIN doctor_visit ON doctor_visit.id = PP.doctor_visit_id WHERE doctor_visit.patient_id='.$editPrescriptionData['patient_id'].' ORDER BY PP.id DESC');
		$previousData = $previousQuery ->fetchAll('assoc');
		$checkPreviousArray = array();
		if(isset($previousData) && !empty($previousData)) {
		foreach($previousData as $key => $value) {
		if(in_array($value["ppID"], $checkPreviousArray))
		{
			unset($previousData[$key]);
		}
		$checkPreviousArray[] = $value["ppID"];
		} }
		//echo "<pre>"; print_r($previousData);die;
		
		$allReports = $conn->execute('SELECT test_master.test_name, patient_test_reports.test_id, patient_test_reports.test_recommended, patient_test_reports.recommended_date, patient_test_reports.test_date, patient_test_reports.test_notes, patient_test_reports.test_report_filename FROM test_master INNER JOIN patient_test_reports ON test_master.id = patient_test_reports.test_id INNER JOIN doctor_visit ON doctor_visit.id=patient_test_reports.doctor_visit_id WHERE doctor_visit.patient_id='.$editPrescriptionData['patient_id'].' ');
		$allReportsData = $allReports ->fetchAll('assoc');
		
		$testMasterData = $testMasterTable->find()
							->select(["id","test_name"])
							->enableHydration(false)
							->toArray();
		
		$this->set(compact("editPrescriptionData","testMasterData","previousData","allReportsData","testReportData"));
		
		$this->render('/Element/Appointment/edit_prescription_left_details');
	}
	
	public function deleteprescription()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$doctorVisitTable = TableRegistry::get('doctor_visit');
		$reportsTable = TableRegistry::get('patient_test_reports');
		$patientPrescriptionsTable = TableRegistry::get('patient_prescriptions');
		$prescriptionTimingsTable = TableRegistry::get('prescription_timings');
		
		$doctorVisitTable->deleteAll(['id IN' => $this->request->getData("id")]);
		$reportsTable->deleteAll(['doctor_visit_id IN' => $this->request->getData("id")]);
		$patientPrescriptionsTable->deleteAll(['doctor_visit_id IN' => $this->request->getData("id")]);
		$prescriptionTimingsTable->deleteAll(['doctor_visit_id IN' => $this->request->getData("id")]);
	}
	
	public function addconditions()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$patientTable = TableRegistry::get('patient_details');
		
		$condtionsData = $this->request->getData("oldCondtions") && !empty($this->request->getData("oldCondtions")) ? $this->request->getData("oldCondtions").",".$this->request->getData("condtionsData") : $this->request->getData("condtionsData");
		
		$patientTable->updateAll(['conditions' => $condtionsData], ['id' => $this->request->getData("id")]);
	}
	
	public function addallergy()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$patientTable = TableRegistry::get('patient_details');
		
		$allergyData = $this->request->getData("oldAllergy") && !empty($this->request->getData("oldAllergy")) ? $this->request->getData("oldAllergy").",".$this->request->getData("allergyData") : $this->request->getData("allergyData");
		
		$patientTable->updateAll(['allergy' => $allergyData], ['id' => $this->request->getData("id")]);
	}
	
	public function addnote()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$notesTable = TableRegistry::get('doctor_notes');
		
		$notesData["id"] = $this->request->getData("notesID") ? $this->request->getData("notesID") : "";
		$notesData["doctor_id"] = $this->request->getData("doctorID") ? $this->request->getData("doctorID") : "";
		$notesData["patient_id"] = $this->request->getData("patientID") ? $this->request->getData("patientID") : "";
		$notesData["notes"] = $this->request->getData("notesData") ? $this->request->getData("notesData") : "";
		$notesData["date"] = $this->request->getData("date") ? $this->request->getData("date") : "";
		
		$notesSave = $notesTable->newEntity($notesData);
		$notesSaveData = $notesTable->save($notesSave);
		
		$doctorNotesData = $notesTable->find()
						  ->select()
						  ->where(["doctor_id"=>$this->request->getData("doctorID"), "patient_id"=>$this->request->getData("patientID")])
						  ->enableHydration(false)
						  ->toArray();
		
		echo json_encode($doctorNotesData);
	}
	
	public function updatequeue()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$appointmentTable = TableRegistry::get('appointment_details');
		
		if($this->request->getData("type")=="addqueue") {
			$appointmentTable->updateAll(['queue_data' => 1], ['id' => $this->request->getData("id")]);
		}
		if($this->request->getData("type")=="removequeue") {
			$appointmentTable->updateAll(['queue_data' => 0], ['id' => $this->request->getData("id")]);
		}
		if($this->request->getData("type")=="paymentqueue") {
			$appointmentTable->updateAll(['payment_data' => 1], ['id' => $this->request->getData("id")]);
		}
		if($this->request->getData("type")=="paymentdone") {
			$appointmentTable->updateAll(['payment_data' => 2], ['id' => $this->request->getData("id")]);
		}
	}

	public function sendmail()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$ppTable = TableRegistry::get('patient_prescriptions');
		$conn = ConnectionManager::get('default');
		//$usersData = explode(",",$this->request->getData("email"));
		$usersData = $this->request->getData("email");
		
		$prescriptionData = json_decode($this->request->getData("emailData"),true);
		$popupData = array();
		foreach($prescriptionData as $key => $value) {
		if(date("d M Y")==$value["visit_date"]) {
			$popupData["doctor_Fname"] = $value["doctor_Fname"];
			$popupData["doctor_Mname"] = $value["doctor_Mname"];
			$popupData["doctor_Lname"] = $value["doctor_Lname"];
			$popupData["patient_title"] = $value["patient_title"];
			$popupData["patient_Fname"] = $value["patient_Fname"];
			$popupData["patient_Mname"] = $value["patient_Mname"];
			$popupData["patient_Lname"] = $value["patient_Lname"];
			$popupData["patient_dob"] = $value["patient_dob"];
			$popupData["patient_address"] = $value["patient_address"];
			$popupData["patient_country"] = $value["patient_country"];
			$popupData["patient_state"] = $value["patient_state"];
			$popupData["visit_date"] = $value["visit_date"];
			$popupData["observation"] = $value["observation"];
			$popupData["patient_notes"] = $value["patient_notes"];
			$popupData["medicine"][$key]["notes"] = $value["notes"];
			$popupData["medicine"][$key]["product_name"] = $value["product_name"];
			$popupData["medicine"][$key]["product_type"] = $value["product_type"];
			$popupData["medicine"][$key]["dosage_qty"] = $value["dosage_qty"];
			$popupData["medicine"][$key]["duration_no"] = $value["duration_no"];
			$popupData["medicine"][$key]["duration_frequency"] = $value["duration_frequency"];
			$popupData["medicine"][$key]["total_qty"] = $value["total_qty"];
			$popupData["medicine"][$key]["day_of_week"] = $value["day_of_week"];
			$popupData["medicine"][$key]["morning"] = $value["morning"];
			$popupData["medicine"][$key]["midday"] = $value["midday"];
			$popupData["medicine"][$key]["afternoon"] = $value["afternoon"];
			$popupData["medicine"][$key]["evening"] = $value["evening"];
			$popupData["medicine"][$key]["dinner"] = $value["dinner"];
			$popupData["medicine"][$key]["morning_quantity"] = $value["morning_quantity"];
			$popupData["medicine"][$key]["afternoon_quantity"] = $value["afternoon_quantity"];
			$popupData["medicine"][$key]["evening_quantity"] = $value["evening_quantity"];
			$popupData["medicine"][$key]["dinner_quantity"] = $value["dinner_quantity"];
			$popupData["medicine"][$key]["custom_times"] = $value["custom_times"];
			$popupData["medicine"][$key]["abbreviation"] = $value["abbreviation"];
			$popupData["medicine"][$key]["abbreviation_meaning"] = $value["abbreviation_meaning"];
		} }
		
		$testReportQuery = $conn->execute('SELECT test_master.test_name, patient_test_reports.test_id, patient_test_reports.test_recommended, patient_test_reports.recommended_date, patient_test_reports.test_date, patient_test_reports.test_notes, patient_test_reports.test_report_filename FROM test_master INNER JOIN patient_test_reports ON test_master.id = patient_test_reports.test_id WHERE patient_test_reports.doctor_visit_id='.$prescriptionData[0]["dvID"].' ');
		$testReportData = $testReportQuery ->fetchAll('assoc');
			
		$popupData = json_encode($popupData);
		$testReportData = json_encode($testReportData);
		
		$email = new Email('default');
				$email->setFrom(['sahil@unikove.com' => 'Unikove']);		
				//$email->setTo($usersData[0]);
				$email->setTo($usersData);
				//$email->setTo("sahilranjan05@gmail.com");
				$email->viewBuilder()->setTemplate('prescriptionemail');
				$email->setEmailFormat('html');
				$email->setViewVars(['emailData' => $popupData, 'testReportData' => $testReportData]);
				$email->setAttachments(['qrcode.png' => ['file' => WWW_ROOT.'img/doctor/qrcode.png','mimetype' => 'image/png','contentId' => '45'], 'Icon-01.png' => ['file' => WWW_ROOT.'img/doctor/pharmacyicon/Icon-01.png','mimetype' => 'image/png','contentId' => '46'], 'Icon-02.png' => ['file' => WWW_ROOT.'img/doctor/pharmacyicon/Icon-02.png','mimetype' => 'image/png','contentId' => '47'], 'Icon-03.png' => ['file' => WWW_ROOT.'img/doctor/pharmacyicon/Icon-03.png','mimetype' => 'image/png','contentId' => '48'], 'Icon-04.png' => ['file' => WWW_ROOT.'img/doctor/pharmacyicon/Icon-04.png','mimetype' => 'image/png','contentId' => '49'], 'Icon-05.png' => ['file' => WWW_ROOT.'img/doctor/pharmacyicon/Icon-05.png','mimetype' => 'image/png','contentId' => '50']]);
				$email->setSubject('Prescription Details');
				$email->send("");
		
		if($this->request->getData("ppID"))
		{
			$ppTable->updateAll(['email_status' => 1], ['id' => $this->request->getData("ppID")]);
		}
	}
	
	public function printdata($id)
	{
		$conn = ConnectionManager::get('default');
		
		$testMasterTable = TableRegistry::get('test_master');
		$appointmentTable = TableRegistry::get('appointment_details');
		$doctorNotesTable = TableRegistry::get('doctor_notes');
		
		$appointmentTable->belongsTo("doctor_details",["foreignKey"=>"doctor_id"]);
		$appointmentTable->belongsTo("patient_details",["foreignKey"=>"patient_id"]);
		
		$prescriptionQuery = $conn->execute('SELECT doctor_details.first_name as doctor_Fname, doctor_details.middle_name as doctor_Mname, doctor_details.last_name as doctor_Lname, patient_details.title as patient_title, patient_details.fname as patient_Fname, patient_details.mname as patient_Mname, patient_details.lname as patient_Lname, patient_details.dob as patient_dob, patient_details.address as patient_address, patient_details.country as patient_country, patient_details.state as patient_state, doctor_visit.id as dvID, doctor_visit.observation, doctor_visit.patient_notes, doctor_visit.visit_date, PP.id as ppID, PP.product_name, PP.product_guid, PP.product_type, PP.dosage_qty, PP.duration_no, PP.duration_frequency, PP.total_qty, PP.notes, PP.email_status, PT.id as ptID, PT.day_of_week, PT.morning, PT.midday, PT.afternoon, PT.evening, PT.dinner, PT.morning_quantity, PT.afternoon_quantity, PT.evening_quantity, PT.dinner_quantity, PT.custom_times, PT.abbreviation, PT.abbreviation_meaning FROM patient_prescriptions AS PP INNER JOIN prescription_timings AS PT ON PP.id = PT.prescription_id RIGHT JOIN doctor_visit ON doctor_visit.id = PP.doctor_visit_id INNER JOIN doctor_details ON doctor_details.id = doctor_visit.doctor_id INNER JOIN patient_details ON patient_details.id = doctor_visit.patient_id WHERE doctor_visit.appointment_id='.base64_decode($id).' ORDER BY PP.id DESC');
		$prescriptionData = $prescriptionQuery ->fetchAll('assoc');
		$checkArray = array();
		if(isset($prescriptionData) && !empty($prescriptionData)) {
		foreach($prescriptionData as $key => $value) {
		if(in_array($value["ppID"], $checkArray))
		{
			unset($prescriptionData[$key]);
		}
		$checkArray[] = $value["ppID"];
		} }
		
		//echo "<pre>"; print_r($prescriptionData);die;
		
		if($prescriptionData[0]['dvID']) {
		$testReportQuery = $conn->execute('SELECT test_master.test_name, patient_test_reports.test_id, patient_test_reports.test_recommended, patient_test_reports.recommended_date, patient_test_reports.test_date, patient_test_reports.test_notes, patient_test_reports.test_report_filename FROM test_master INNER JOIN patient_test_reports ON test_master.id = patient_test_reports.test_id WHERE patient_test_reports.doctor_visit_id='.$prescriptionData[0]['dvID'].' ');
		$testReportData = $testReportQuery ->fetchAll('assoc');
		}

		$popupData = array();
		foreach($prescriptionData as $key => $value) {
		//if(date("d M Y")==$value["visit_date"]) {
			$popupData["doctor_Fname"] = $value["doctor_Fname"];
			$popupData["doctor_Mname"] = $value["doctor_Mname"];
			$popupData["doctor_Lname"] = $value["doctor_Lname"];
			$popupData["patient_title"] = $value["patient_title"];
			$popupData["patient_Fname"] = $value["patient_Fname"];
			$popupData["patient_Mname"] = $value["patient_Mname"];
			$popupData["patient_Lname"] = $value["patient_Lname"];
			$popupData["patient_dob"] = $value["patient_dob"];
			$popupData["patient_address"] = $value["patient_address"];
			$popupData["patient_country"] = $value["patient_country"];
			$popupData["patient_state"] = $value["patient_state"];
			$popupData["visit_date"] = $value["visit_date"];
			$popupData["observation"] = $value["observation"];
			$popupData["patient_notes"] = $value["patient_notes"];
			$popupData["medicine"][$key]["notes"] = $value["notes"];
			$popupData["medicine"][$key]["product_name"] = $value["product_name"];
			$popupData["medicine"][$key]["product_type"] = $value["product_type"];
			$popupData["medicine"][$key]["dosage_qty"] = $value["dosage_qty"];
			$popupData["medicine"][$key]["duration_no"] = $value["duration_no"];
			$popupData["medicine"][$key]["duration_frequency"] = $value["duration_frequency"];
			$popupData["medicine"][$key]["total_qty"] = $value["total_qty"];
			$popupData["medicine"][$key]["day_of_week"] = $value["day_of_week"];
			$popupData["medicine"][$key]["morning"] = $value["morning"];
			$popupData["medicine"][$key]["midday"] = $value["midday"];
			$popupData["medicine"][$key]["afternoon"] = $value["afternoon"];
			$popupData["medicine"][$key]["evening"] = $value["evening"];
			$popupData["medicine"][$key]["dinner"] = $value["dinner"];
			$popupData["medicine"][$key]["morning_quantity"] = $value["morning_quantity"];
			$popupData["medicine"][$key]["afternoon_quantity"] = $value["afternoon_quantity"];
			$popupData["medicine"][$key]["evening_quantity"] = $value["evening_quantity"];
			$popupData["medicine"][$key]["dinner_quantity"] = $value["dinner_quantity"];
			$popupData["medicine"][$key]["custom_times"] = $value["custom_times"];
			$popupData["medicine"][$key]["abbreviation"] = $value["abbreviation"];
			$popupData["medicine"][$key]["abbreviation_meaning"] = $value["abbreviation_meaning"];
		} //}
		//echo "<pre>";print_r($popupData);die;
		
		$qrImage = PATH."img/doctor/qrcode.png";
		$patchImage = PATH."img/doctor/pharmacyicon/Icon-01.png";
		$gelCreamImage = PATH."img/doctor/pharmacyicon/Icon-02.png";
		$injectionImage = PATH."img/doctor/pharmacyicon/Icon-03.png";
		$capsuleImage = PATH."img/doctor/pharmacyicon/Icon-04.png";
		$tabletImage = PATH."img/doctor/pharmacyicon/Icon-05.png";
		
		$this->set(compact("testReportData","popupData","qrImage","patchImage","gelCreamImage","injectionImage","capsuleImage","tabletImage"));
	}
	
	public function bulkcancellation()
	{
	}
	
	public function blackoutdatelisting()
	{
	}
	
	public function createblackoutdate()
	{
	}
	
	public function editblackoutdate()
	{
	}
	
	public function checkAbbreviation()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$abbreviationMasterTable = TableRegistry::get('abbreviation_master');
		
		$abbreviationData = array();
		$abbreviationMeaning = array();
		if($this->request->getData("abbreviation"))
		{
			$abbreviation = explode(" ",$this->request->getData("abbreviation"));
			foreach($abbreviation as $key => $value)
			{
				$abbreviationData[$key] = $abbreviationMasterTable->find()->select(["meaning"])->where(["abbreviation"=>$value])->enableHydration(false)->first();
				$abbreviationData[$key]["abbreviation"] = $value;
			}
			if(isset($abbreviationData) && !empty($abbreviationData))
			{
				foreach($abbreviationData as $k => $v)
				{
					if(!empty($v["meaning"]))
					{
						$abbreviationMeaning[$k] = $v["meaning"];
					}
					else
					{
						$abbreviationMeaning[$k] = $v["abbreviation"];
					}
				}
				echo implode(" ",$abbreviationMeaning);
			}
		}
	}
	
	function CimsData($url,$input_xml)
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
		
        curl_setopt($ch, CURLOPT_POSTFIELDS,"xmlRequest=" . $input_xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $data = curl_exec($ch);
        curl_close($ch);
		
        $data = json_decode(json_encode(simplexml_load_string($data)), true);
		
		return $data;
	}
	
	public function getCimsMedicines()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$url = CimsURL;
		$input_xml = $this->request->getData("CIMS_Request");
		
		$data = $this->CimsData($url,$input_xml);
		
		$medicines = array();
		if(isset($data["List"]["Product"]) && !empty($data["List"]["Product"])) //BRAND DATA
		{
			foreach(array_values($data["List"]["Product"]) as $key => $value)
			{
				$medicines[$key]["id"] = isset($value["@attributes"]["reference"]) ? $value["@attributes"]["reference"]."_".$value["@attributes"]["name"] : $data["List"]["Product"]["@attributes"]["reference"]."_".$data["List"]["Product"]["@attributes"]["name"];
				$medicines[$key]["name"] = isset($value["@attributes"]["name"]) ? $value["@attributes"]["name"] : $data["List"]["Product"]["@attributes"]["name"];
				$medicines[$key]["type"] = "Product";
			}
		}
		
		if(isset($data["List"]["Molecule"]) && !empty($data["List"]["Molecule"])) //MOLECULE DATA
		{
			foreach(array_values($data["List"]["Molecule"]) as $key => $value)
			{
				$medicines[$key]["id"] = isset($value["@attributes"]["reference"]) ? $value["@attributes"]["reference"]."_".$value["@attributes"]["name"] : $data["List"]["Molecule"]["@attributes"]["reference"]."_".$data["List"]["Molecule"]["@attributes"]["name"];
				$medicines[$key]["name"] = isset($value["@attributes"]["name"]) ? $value["@attributes"]["name"] : $data["List"]["Molecule"]["@attributes"]["name"];
				$medicines[$key]["type"] = "Molecule";
			}
		}

        echo json_encode($medicines); die;
	}
	
	public function getBrandsFromMolecule()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$url = CimsURL;
		$input_xml = $this->request->getData("CIMS_Request");
		
        $data = $this->CimsData($url,$input_xml);
		
		$medicines = array();
		if(isset($data["List"]["Product"]) && !empty($data["List"]["Product"]))
		{
			foreach(array_values($data["List"]["Product"]) as $key => $value)
			{
				$medicines[$key]["id"] = isset($value["@attributes"]["reference"]) ? $value["@attributes"]["reference"] : $data["List"]["Product"]["@attributes"]["reference"];
				$medicines[$key]["name"] = isset($value["@attributes"]["name"]) ? $value["@attributes"]["name"] : $data["List"]["Product"]["@attributes"]["name"];
				$medicines[$key]["type"] = "Product";
			}
		}

        echo json_encode($medicines); die;
	}
	
	public function getCompanyFormName()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$url = CimsURL;
		$input_xml = $this->request->getData("CIMS_Request");
		
        $data = $this->CimsData($url,$input_xml);
		
		$medicineDetails = array();
		if(isset($data["Detail"]["Product"]["Companies"]["Company"]["@attributes"]["name"]))
		{
			$medicineDetails["companyName"] = $data["Detail"]["Product"]["Companies"]["Company"]["@attributes"]["name"];
		}
		else
		{
			$medicineDetails["companyName"] = "";
		}
		
		if(isset($data["Detail"]["Product"]["Items"]["Item"]["Form"]["@attributes"]["name"]))
		{
			$medicineDetails["formName"] = $data["Detail"]["Product"]["Items"]["Item"]["Form"]["@attributes"]["name"];
		}
		else
		{
			$medicineDetails["formName"] = "";
		}

        echo json_encode($medicineDetails); die;
	}
	
}












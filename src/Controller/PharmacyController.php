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

class PharmacyController extends AppController
{
	public function initialize()
    {
        parent::initialize();		
		$this->loadComponent('Emailer');
	}
	
	function listing()
	{
		$conn = ConnectionManager::get('default');
		
		$prescriptionQuery = $conn->execute('select PPOI.prescription_id, doctor_details.first_name AS DoctorFirstName, doctor_details.middle_name AS DoctorMiddleName, doctor_details.last_name AS DoctorLastName, patient_details.fname AS PatientFirstName, patient_details.mname AS PatientMiddleName, patient_details.lname AS PatientLastName, patient_details.m_number AS PatientNumber FROM pharmacy_prescription_order_items as PPOI INNER JOIN pharmacy_prescription ON pharmacy_prescription.id = PPOI.prescription_id INNER JOIN doctor_details ON doctor_details.id = pharmacy_prescription.doctor_id INNER JOIN patient_details ON patient_details.id = pharmacy_prescription.patient_id ');
		$prescriptionData = $prescriptionQuery ->fetchAll('assoc');
		
		$prescriptionIDArray = array();
		$savedPrescription = array();
		if(!empty($prescriptionData)) {
		foreach($prescriptionData as $key => $value)
		{	
			if(!in_array($value["prescription_id"],$prescriptionIDArray))
			{
				$savedPrescription[$key]["prescription_id"] = $value["prescription_id"];
				$savedPrescription[$key]["doctor_name"] = $value["DoctorFirstName"]." ".$value["DoctorMiddleName"]." ".$value["DoctorLastName"];
				$savedPrescription[$key]["patient_name"] = $value["PatientFirstName"]." ".$value["PatientMiddleName"]." ".$value["PatientLastName"];
				$savedPrescription[$key]["patient_phone"] = $value["PatientNumber"];
			}
			$prescriptionIDArray[] = $value["prescription_id"];
		} }
		$savedPrescription = array_values($savedPrescription);
		$this->set(compact("savedPrescription"));
	}
	
	function billingdetails($prescriptionID)
	{
		$conn = ConnectionManager::get('default');
		
		$prescriptionQuery = $conn->execute('select pharmacy_prescription.created_dttm as createdDate, PPOI.*, doctor_details.first_name AS DoctorFirstName, doctor_details.middle_name AS DoctorMiddleName, doctor_details.last_name AS DoctorLastName, patient_details.title AS PatientTitle, patient_details.fname AS PatientFirstName, patient_details.mname AS PatientMiddleName, patient_details.lname AS PatientLastName, patient_details.dob AS PatientDOB, patient_details.address AS patient_address, patient_details.country AS patient_country, patient_details.state AS patient_state FROM pharmacy_prescription_order_items as PPOI INNER JOIN pharmacy_prescription ON pharmacy_prescription.id = PPOI.prescription_id INNER JOIN doctor_details ON doctor_details.id = pharmacy_prescription.doctor_id INNER JOIN patient_details ON patient_details.id = pharmacy_prescription.patient_id WHERE PPOI.prescription_id = '.base64_decode($prescriptionID).' ');
		$prescriptionData = $prescriptionQuery ->fetchAll('assoc');
		
		$productIDArray = array();
		$savedPrescription = array();
		if(!empty($prescriptionData)) {
		foreach(array_reverse($prescriptionData) as $key => $value)
		{
			if(!in_array($value["product_id"],$productIDArray))
			{
				$savedPrescription[$key]["prescription_id"] = $value["prescription_id"];
				$savedPrescription[$key]["product_id"] = $value["product_id"];
				$savedPrescription[$key]["product_name"] = $value["product_name"];
				$savedPrescription[$key]["product_type"] = $value["product_type"];
				$savedPrescription[$key]["dosage_qty"] = $value["dosage_qty"];
				$savedPrescription[$key]["dosage_frequency"] = $value["dosage_frequency"];
				$savedPrescription[$key]["duration_no"] = $value["duration_no"];
				$savedPrescription[$key]["duration_frequency"] = $value["duration_frequency"];
				$savedPrescription[$key]["total_qty"] = $value["total_qty"];
				$savedPrescription[$key]["day_of_week"] = $value["day_of_week"];
				$savedPrescription[$key]["notes"] = $value["notes"];
				$savedPrescription[$key]["morning"] = $value["morning"];
				$savedPrescription[$key]["afternoon"] = $value["afternoon"];
				$savedPrescription[$key]["evening"] = $value["evening"];
				$savedPrescription[$key]["dinner"] = $value["dinner"];
				$savedPrescription[$key]["morning_quantity"] = $value["morning_quantity"];
				$savedPrescription[$key]["afternoon_quantity"] = $value["afternoon_quantity"];
				$savedPrescription[$key]["evening_quantity"] = $value["evening_quantity"];
				$savedPrescription[$key]["dinner_quantity"] = $value["dinner_quantity"];
				$savedPrescription[$key]["custom_times"] = $value["custom_times"];
				$savedPrescription[$key]["abbreviation"] = $value["abbreviation"];
				$savedPrescription[$key]["abbreviation_meaning"] = $value["abbreviation_meaning"];
				$savedPrescription[$key]["unit_price_total"] = $value["unit_price_total"];
				$savedPrescription[$key]["created_dttm"] = $value["createdDate"];
				$savedPrescription[$key]["doctor_name"] = $value["DoctorFirstName"]." ".$value["DoctorMiddleName"]." ".$value["DoctorLastName"];
				$savedPrescription[$key]["patient_name"] = $value["PatientTitle"]." ".$value["PatientFirstName"]." ".$value["PatientMiddleName"]." ".$value["PatientLastName"];
				$savedPrescription[$key]["patient_dob"] = $value["PatientDOB"];
				$savedPrescription[$key]["patient_address"] = $value["patient_address"].", ".$value["patient_country"].", ".$value["patient_state"];
			}
			$productIDArray[] = $value["product_id"];
		} }
		
		if(!empty($savedPrescription))
		{
			foreach($savedPrescription as $key => $value)
			{
				$inventoryQuery = $conn->execute('select PPOI.quantity, PPOI.expiry_date, IDT.batch_no FROM pharmacy_prescription_order_items AS PPOI INNER JOIN inventory_details AS IDT ON PPOI.inventory_id=IDT.id WHERE PPOI.prescription_id='.$value["prescription_id"].' AND PPOI.product_id='.$value["product_id"].' ');
				$savedPrescription[$key]["inventory"] = $inventoryQuery ->fetchAll('assoc');
			}
		}
		
		$savedPrescription = array_values($savedPrescription);
		$this->set(compact("savedPrescription"));
	}
	
	function printdata($prescriptionID)
	{
		$conn = ConnectionManager::get('default');
		
		$prescriptionQuery = $conn->execute('select pharmacy_prescription.created_dttm as createdDate, PPOI.*, doctor_details.first_name AS DoctorFirstName, doctor_details.middle_name AS DoctorMiddleName, doctor_details.last_name AS DoctorLastName, patient_details.title AS PatientTitle, patient_details.fname AS PatientFirstName, patient_details.mname AS PatientMiddleName, patient_details.lname AS PatientLastName, patient_details.dob AS PatientDOB, patient_details.address AS patient_address, patient_details.country AS patient_country, patient_details.state AS patient_state FROM pharmacy_prescription_order_items as PPOI INNER JOIN pharmacy_prescription ON pharmacy_prescription.id = PPOI.prescription_id INNER JOIN doctor_details ON doctor_details.id = pharmacy_prescription.doctor_id INNER JOIN patient_details ON patient_details.id = pharmacy_prescription.patient_id WHERE PPOI.prescription_id = '.base64_decode($prescriptionID).' ');
		$prescriptionData = $prescriptionQuery ->fetchAll('assoc');
		
		$productIDArray = array();
		$savedPrescription = array();
		if(!empty($prescriptionData)) {
		foreach(array_reverse($prescriptionData) as $key => $value)
		{
			if(!in_array($value["product_id"],$productIDArray))
			{
				$savedPrescription[$key]["prescription_id"] = $value["prescription_id"];
				$savedPrescription[$key]["product_id"] = $value["product_id"];
				$savedPrescription[$key]["product_name"] = $value["product_name"];
				$savedPrescription[$key]["product_type"] = $value["product_type"];
				$savedPrescription[$key]["dosage_qty"] = $value["dosage_qty"];
				$savedPrescription[$key]["dosage_frequency"] = $value["dosage_frequency"];
				$savedPrescription[$key]["duration_no"] = $value["duration_no"];
				$savedPrescription[$key]["duration_frequency"] = $value["duration_frequency"];
				$savedPrescription[$key]["total_qty"] = $value["total_qty"];
				$savedPrescription[$key]["day_of_week"] = $value["day_of_week"];
				$savedPrescription[$key]["notes"] = $value["notes"];
				$savedPrescription[$key]["morning"] = $value["morning"];
				$savedPrescription[$key]["afternoon"] = $value["afternoon"];
				$savedPrescription[$key]["evening"] = $value["evening"];
				$savedPrescription[$key]["dinner"] = $value["dinner"];
				$savedPrescription[$key]["morning_quantity"] = $value["morning_quantity"];
				$savedPrescription[$key]["afternoon_quantity"] = $value["afternoon_quantity"];
				$savedPrescription[$key]["evening_quantity"] = $value["evening_quantity"];
				$savedPrescription[$key]["dinner_quantity"] = $value["dinner_quantity"];
				$savedPrescription[$key]["custom_times"] = $value["custom_times"];
				$savedPrescription[$key]["abbreviation"] = $value["abbreviation"];
				$savedPrescription[$key]["abbreviation_meaning"] = $value["abbreviation_meaning"];
				$savedPrescription[$key]["unit_price_total"] = $value["unit_price_total"];
				$savedPrescription[$key]["created_dttm"] = $value["createdDate"];
				$savedPrescription[$key]["doctor_name"] = $value["DoctorFirstName"]." ".$value["DoctorMiddleName"]." ".$value["DoctorLastName"];
				$savedPrescription[$key]["patient_name"] = $value["PatientTitle"]." ".$value["PatientFirstName"]." ".$value["PatientMiddleName"]." ".$value["PatientLastName"];
				$savedPrescription[$key]["patient_dob"] = $value["PatientDOB"];
				$savedPrescription[$key]["patient_address"] = $value["patient_address"].", ".$value["patient_country"].", ".$value["patient_state"];
			}
			$productIDArray[] = $value["product_id"];
		} }
		
		if(!empty($savedPrescription))
		{
			foreach($savedPrescription as $key => $value)
			{
				$inventoryQuery = $conn->execute('select PPOI.quantity, PPOI.expiry_date, IDT.batch_no FROM pharmacy_prescription_order_items AS PPOI INNER JOIN inventory_details AS IDT ON PPOI.inventory_id=IDT.id WHERE PPOI.prescription_id='.$value["prescription_id"].' AND PPOI.product_id='.$value["product_id"].' ');
				$savedPrescription[$key]["inventory"] = $inventoryQuery ->fetchAll('assoc');
			}
		}
		
		$qrImage = PATH."img/doctor/qrcode.png";
		$patchImage = PATH."img/doctor/pharmacyicon/Icon-01.png";
		$gelCreamImage = PATH."img/doctor/pharmacyicon/Icon-02.png";
		$injectionImage = PATH."img/doctor/pharmacyicon/Icon-03.png";
		$capsuleImage = PATH."img/doctor/pharmacyicon/Icon-04.png";
		$tabletImage = PATH."img/doctor/pharmacyicon/Icon-05.png";
		
		$savedPrescription = array_values($savedPrescription);
		$this->set(compact("savedPrescription","qrImage","patchImage","gelCreamImage","injectionImage","capsuleImage","tabletImage"));
	}
	
	function billing()
	{
		$role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
		$users_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : ""; 
	
		if(!$users_id)
		{
			$this->redirect(['controller'=>'Login','action'=>'index']);
		}
		
		$doctorTable = TableRegistry::get('doctor_details');
		$patientTable = TableRegistry::get('patient_details');
		$orderFormTable = TableRegistry::get('order_form');
		
		$doctorData = $doctorTable->find()
						  ->select(["id","first_name","middle_name","last_name"])
						  ->where(["clinic_id"=>$this->request->getSession()->read('clinic_id')])
						  ->enableHydration(false)
						  ->toArray();
		
		$patientData = $patientTable->find()
						  ->select(["id","title","fname","mname","lname","m_number"])
						  ->where(["clinic_id"=>$this->request->getSession()->read('clinic_id')])
						  ->order(['id'=>'DESC'])
						  ->enableHydration(false)
						  ->toArray();
						  
		$orderFormData = $orderFormTable->find()
						  ->select(["id","order_name"])
						  ->where(["pharmacy_id"=>"1"])
						  ->enableHydration(false)
						  ->toArray();
		
		$this->set(compact("doctorData","patientData","orderFormData"));
	}
	
	function getPatitentData()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$patientTable = TableRegistry::get('patient_details');
		
		$patientData = $patientTable->find()
						  ->select()
						  ->where(["id"=>$this->request->getData("id")])
						  ->enableHydration(false)
						  ->first();
		
		echo json_encode($patientData);
	}
	
	public function save()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		//echo "<pre>"; print_r($this->request->getData());die;
		$pharmacyPrescriptionTable = TableRegistry::get('pharmacy_prescription');
		$pharmacyPrescriptionOrderItemsTable = TableRegistry::get('pharmacy_prescription_order_items');
		$inventoryTable = TableRegistry::get('inventory_details');
		$abbreviationTable = TableRegistry::get('abbreviation_master');
		
		//SAVE DATA IN 'pharmacy_prescription' TABLE
		$ppData["id"] = $this->request->getData("prescription_id") ? $this->request->getData("prescription_id") : "";
		$ppData["pharmacy_id"] = 1;
		$ppData["patient_id"] = $this->request->getData("patient_id") ? $this->request->getData("patient_id") : "";
		$ppData["doctor_id"] = $this->request->getData("doctor_id") ? $this->request->getData("doctor_id") : "";
		if(!$this->request->getData("prescription_id"))
		{
			$ppData["created_dttm"] = date("Y-m-d H:i:s");
		}
		$ppData["modified_dttm"] = date("Y-m-d H:i:s");
		
		$ppSave = $pharmacyPrescriptionTable->newEntity($ppData);
		$ppSaveData = $pharmacyPrescriptionTable->save($ppSave);
		//SAVE DATA IN 'pharmacy_prescription' TABLE
		
		//SAVE DATA IN 'pharmacy_prescription_order_items' TABLE
		$explodeName = $this->request->getData("product_name") && !empty($this->request->getData("product_name")) ? explode("_",$this->request->getData("product_name")) : "";
		
		$abbreviation = explode(" ",$this->request->getData("abbreviation"));
		if(isset($abbreviation) && !empty($abbreviation))
		{
			foreach($abbreviation as $key => $value)
			{
				$abbreviationData[] = $abbreviationTable->find()->select(["meaning"])->where(["abbreviation"=>$value])->enableHydration(false)->first();
			}
		}
		if(isset($abbreviationData) && !empty($abbreviationData))
		{
			foreach($abbreviationData as $key => $value)
			{
				if(!empty($value["meaning"]))
				{
					$abbreviationMeaning[] = $value["meaning"];
				}
				else
				{
					$abbreviationMeaning[] = $abbreviation[$key];
				}
			}
		}
		
		$pharmacyPrescriptionOrderItemsTable->deleteAll(['prescription_id'=>$this->request->getData("prescription_id"), 'product_id'=>$this->request->getData("product_id")]);
		
		$count = 0;
		if(!empty($this->request->getData("inventory_id"))) {
		foreach($this->request->getData("inventory_id") as $inventoryKey => $inventoryValue)
		{	
			$quantityOrdered = $this->request->getData("quantity")[$inventoryKey];
			$unitPrice = $this->request->getData("unit_price")[$inventoryKey];
			$quantityPerPack = $this->request->getData("total_quantity")[$inventoryKey] / $this->request->getData("totalPacks")[$inventoryKey];
			$pricePerPack = $unitPrice / $this->request->getData("totalPacks")[$inventoryKey];
			
			$pricePerMedicine = $pricePerPack / $quantityPerPack;
			
			$finalPrice = $quantityOrdered * $pricePerMedicine;

			$count = $count + ceil($finalPrice);
		
			$ppoiData["id"] = $this->request->getData("id") ? $this->request->getData("id") : "";
			$ppoiData["prescription_id"] = $ppSaveData->id;
			$ppoiData["product_id"] = $this->request->getData("product_id") ? $this->request->getData("product_id") : "";
			$ppoiData["inventory_id"] = $inventoryValue;
			$ppoiData["quantity"] = $quantityOrdered ? $quantityOrdered : "";
			$ppoiData["expiry_date"] = $this->request->getData("expiry_date")[$inventoryKey];
			$ppoiData["unit_price"] = $finalPrice ? ceil($finalPrice) : "";
			$ppoiData["unit_price_total"] = $count;
			$ppoiData["product_guid"] = isset($explodeName[0]) ? $explodeName[0] : "";
			$ppoiData["product_name"] = isset($explodeName[1]) ? $explodeName[1] : "";
			$ppoiData["product_type"] = $this->request->getData("product_type") ? $this->request->getData("product_type") : "";
			$ppoiData["dosage_qty"] = $this->request->getData("customCheck")!=1 && $this->request->getData("dosage_qty") ? $this->request->getData("dosage_qty") : "";
			$ppoiData["dosage_frequency"] = $this->request->getData("customCheck")!=1 && $this->request->getData("dosage_frequency") ? $this->request->getData("dosage_frequency") : "";
			$ppoiData["duration_no"] = $this->request->getData("duration_no") ? $this->request->getData("duration_no") : "";
			$ppoiData["duration_frequency"] = $this->request->getData("duration_frequency") ? $this->request->getData("duration_frequency") : "";
			$ppoiData["total_qty"] = $this->request->getData("total_qty") ? $this->request->getData("total_qty") : "";
			$ppoiData["notes"] = $this->request->getData("notes") ? $this->request->getData("notes") : "";
			$ppoiData["created_dttm"] = date("Y-m-d H:i:s");
			$ppoiData["modified_dttm"] = date("Y-m-d H:i:s");
			
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
			$ppoiData["day_of_week"] = isset($weekData) && $this->request->getData("customCheck")!=1 ? implode(",",$weekData) : "";
			$ppoiData["morning"] = $this->request->getData("customCheck")!=1 && $this->request->getData("morning") ? $this->request->getData("morning") : "";
			$ppoiData["afternoon"] = $this->request->getData("customCheck")!=1 && $this->request->getData("afternoon") ? $this->request->getData("afternoon") : "";
			$ppoiData["evening"] = $this->request->getData("customCheck")!=1 && $this->request->getData("evening") ? $this->request->getData("evening") : "";
			$ppoiData["dinner"] = $this->request->getData("customCheck")!=1 && $this->request->getData("dinner") ? $this->request->getData("dinner") : "";
			$ppoiData["morning_quantity"] = $this->request->getData("customCheck")!=1 && $this->request->getData("morning_quantity") ? $this->request->getData("morning_quantity") : "";
			$ppoiData["afternoon_quantity"] = $this->request->getData("customCheck")!=1 && $this->request->getData("afternoon_quantity") ? $this->request->getData("afternoon_quantity") : "";
			$ppoiData["evening_quantity"] = $this->request->getData("customCheck")!=1 && $this->request->getData("evening_quantity") ? $this->request->getData("evening_quantity") : "";
			$ppoiData["dinner_quantity"] = $this->request->getData("customCheck")!=1 && $this->request->getData("dinner_quantity") ? $this->request->getData("dinner_quantity") : "";
			$ppoiData["custom_times"] = isset($customTimes) && !empty($customTimes) && $this->request->getData("customCheck")==1 ? json_encode($customTimes) : "";
			
			//$ppoiData["abbreviation"] = $this->request->getData("customCheck")==1 && $this->request->getData("abbreviation") ? $this->request->getData("abbreviation") : "";
			//$ppoiData["abbreviation_meaning"] = isset($abbreviationMeaning) && !empty($abbreviationMeaning) && $this->request->getData("customCheck")==1 ? implode(" ",$abbreviationMeaning) : "";
			
			$ppoiSave = $pharmacyPrescriptionOrderItemsTable->newEntity($ppoiData);
			$ppoiSaveData = $pharmacyPrescriptionOrderItemsTable->save($ppoiSave);
		} }
		//SAVE DATA IN 'pharmacy_prescription_order_items' TABLE
		
		
		//UPDATE DATA IN 'inventory_details' TABLE
		if($this->request->getData("inventory_id") && !empty($this->request->getData("inventory_id")))
		{
			foreach($this->request->getData("inventory_id") as $key => $value)
			{
				
				$quantityOrdered = $this->request->getData("quantity")[$key];
				
				$inventoryTable->updateAll(['qty_available'=>ceil($this->request->getData("quantity_left")[$key]) - $quantityOrdered], ['id' => $value]);
			}
		}
		//UPDATE DATA IN 'inventory_details' TABLE
		
		$prescriptionID = $ppSaveData->id;
		$patientID = $ppData["patient_id"];
		$doctorID = $ppData["doctor_id"];
		$this->set(compact("prescriptionID","patientID","doctorID"));
		$this->render('/Element/Pharmacy/prescription_left_details');
	}
	
	public function getsavedprescription()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$conn = ConnectionManager::get('default');
		
		$prescriptionQuery = $conn->execute('select PPOI.id, PPOI.prescription_id, PPOI.product_id, PPOI.unit_price_total, PPOI.product_name, PPOI.product_guid, PPOI.product_type, PPOI.total_qty FROM pharmacy_prescription_order_items as PPOI INNER JOIN pharmacy_prescription ON pharmacy_prescription.id = PPOI.prescription_id WHERE pharmacy_prescription.id='.$this->request->getData("prescriptionID").' AND pharmacy_prescription.pharmacy_id=1 ');
		$prescriptionData = $prescriptionQuery ->fetchAll('assoc');
		
		$productIDArray = array();
		$savedPrescription = array();
		if(!empty($prescriptionData)) {
		foreach(array_reverse($prescriptionData) as $key => $value)
		{
			if(!in_array($value["product_id"],$productIDArray))
			{
				$savedPrescription[$key]["prescriptionID"] = $value["prescription_id"];
				$savedPrescription[$key]["productID"] = $value["product_id"];
				$savedPrescription[$key]["id"] = $value["prescription_id"]."_".$value["product_id"];
				$savedPrescription[$key]["product_name"] = $value["product_name"];
				$savedPrescription[$key]["product_guid"] = $value["product_guid"];
				$savedPrescription[$key]["product_type"] = $value["product_type"];
				$savedPrescription[$key]["total_qty"] = $value["total_qty"];
				$savedPrescription[$key]["unit_price_total"] = $value["unit_price_total"];
			}
			$productIDArray[] = $value["product_id"];
		} }
		
		if(!empty($savedPrescription))
		{
			foreach($savedPrescription as $key => $value)
			{
				$inventoryQuery = $conn->execute('select PPOI.quantity, PPOI.expiry_date, IDT.batch_no FROM pharmacy_prescription_order_items AS PPOI INNER JOIN inventory_details AS IDT ON PPOI.inventory_id=IDT.id WHERE PPOI.prescription_id='.$value["prescriptionID"].' AND PPOI.product_id='.$value["productID"].' ');
				$savedPrescription[$key]["inventory"] = $inventoryQuery ->fetchAll('assoc');
			}
		}
		
		$prescriptionID = base64_encode($this->request->getData("prescriptionID"));
		//echo "<pre>"; echo $prescriptionID; print_r($savedPrescription);die;
		$this->set(compact("savedPrescription","prescriptionID"));
		$this->render('/Element/Pharmacy/prescription_right_details');
	}
	
	public function editprescription()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$conn = ConnectionManager::get('default');
		
		$ppoiTable = TableRegistry::get('pharmacy_prescription_order_items');
		$inventoryTable = TableRegistry::get('inventory_details');
						  
		$explode = explode("_",$this->request->getData("id"));
		
		$prescriptionID = $explode[0];
		$productID = $explode[1];
		
		$inventoryData = $inventoryTable->find()->select(["id","batch_no","qty_available","quantity","unit_price","no_of_pack"])->where(["product_id"=>$productID])->enableHydration(false)->toArray();
		
		$prescriptionQuery = $conn->execute('select pharmacy_prescription.patient_id, pharmacy_prescription.doctor_id, PPOI.* FROM pharmacy_prescription_order_items as PPOI INNER JOIN pharmacy_prescription ON pharmacy_prescription.id = PPOI.prescription_id WHERE PPOI.prescription_id='.$prescriptionID.' AND PPOI.product_id='.$productID.' ');
		$prescriptionData = $prescriptionQuery ->fetchAll('assoc');
		
		if(!empty($prescriptionData))
		{
			foreach($prescriptionData as $key => $value)
			{
				if($key==0)
				{
					$editPrescriptionData["patient_id"] = $value["patient_id"];
					$editPrescriptionData["doctor_id"] = $value["doctor_id"];
					$editPrescriptionData["prescription_id"] = $value["prescription_id"];
					$editPrescriptionData["product_id"] = $value["product_id"];
					$editPrescriptionData["product_guid"] = $value["product_guid"];
					$editPrescriptionData["product_name"] = $value["product_name"];
					$editPrescriptionData["product_type"] = $value["product_type"];
					$editPrescriptionData["dosage_qty"] = $value["dosage_qty"];
					$editPrescriptionData["dosage_frequency"] = $value["dosage_frequency"];
					$editPrescriptionData["duration_no"] = $value["duration_no"];
					$editPrescriptionData["duration_frequency"] = $value["duration_frequency"];
					$editPrescriptionData["total_qty"] = $value["total_qty"];
					$editPrescriptionData["notes"] = $value["notes"];
					$editPrescriptionData["morning"] = $value["morning"];
					$editPrescriptionData["afternoon"] = $value["afternoon"];
					$editPrescriptionData["evening"] = $value["evening"];
					$editPrescriptionData["dinner"] = $value["dinner"];
					$editPrescriptionData["morning_quantity"] = $value["morning_quantity"];
					$editPrescriptionData["afternoon_quantity"] = $value["afternoon_quantity"];
					$editPrescriptionData["evening_quantity"] = $value["evening_quantity"];
					$editPrescriptionData["dinner_quantity"] = $value["dinner_quantity"];
					$editPrescriptionData["custom_times"] = $value["custom_times"];
					$editPrescriptionData["abbreviation"] = $value["abbreviation"];
					$editPrescriptionData["abbreviation_meaning"] = $value["abbreviation_meaning"];
				}
				$editPrescriptionData["inventory"][$key]["id"] = $value["id"];
				$editPrescriptionData["inventory"][$key]["quantity"] = $value["quantity"];
				$editPrescriptionData["inventory"][$key]["expiry_date"] = $value["expiry_date"];
				$editPrescriptionData["inventory"][$key]["inventory_id"] = $value["inventory_id"];
			}
		}
		
		$this->set(compact("editPrescriptionData","inventoryData"));
		//echo "<pre>"; print_r($editPrescriptionData);die;
		$this->render('/Element/Pharmacy/edit_prescription_left_details');
	}
	
	public function deleteprescription()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$explode = explode("_",$this->request->getData("id"));
		
		$prescriptionID = $explode[0];
		$productID = $explode[1];
		
		$pharmacyPrescriptionOrderItemsTable = TableRegistry::get('pharmacy_prescription_order_items');
		
		$pharmacyPrescriptionOrderItemsTable->deleteAll(['prescription_id'=>$prescriptionID, 'product_id'=>$productID]);
		
		
		$prescriptionData = $pharmacyPrescriptionOrderItemsTable->find()->select(["product_id","unit_price_total"])->where(["prescription_id"=>$prescriptionID])->enableHydration(false)->toArray();
		$productIDArray = array();
		$savedPrescription = array();
		if(!empty($prescriptionData)) {
		foreach(array_reverse($prescriptionData) as $key => $value)
		{
			if(!in_array($value["product_id"],$productIDArray))
			{
				$savedPrescription[$key]["unit_price_total"] = $value["unit_price_total"];
			}
			$productIDArray[] = $value["product_id"];
		} }
		
		$count = 0;
		foreach($savedPrescription as $key => $value)
		{
			$count = $count + $value["unit_price_total"];
		}
		echo $count;
	}
	
	public function sendmail()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$conn = ConnectionManager::get('default');
		
		$patientQuery = $conn->execute('select PPOI.product_name, PPOI.product_guid, PPOI.dosage_frequency, PPOI.duration_no, PPOI.duration_frequency, PPOI.total_qty, PPOI.day_of_week, PPOI.created_dttm FROM pharmacy_prescription_order_items as PPOI INNER JOIN pharmacy_prescription ON pharmacy_prescription.id = PPOI.prescription_id WHERE pharmacy_prescription.patient_id='.$this->request->getData("patient_id"));
		$patientData = $patientQuery ->fetchAll('assoc');
		
		$productIDArray = array();
		$savedPatientDrugs = array();
		if(!empty($patientData)) {
		foreach(array_reverse($patientData) as $key => $value)
		{
			$date = explode(" ",$value["created_dttm"]);
			if(!in_array($value["product_guid"],$productIDArray))
			{
				$savedPatientDrugs[$key]["product_name"] = $value["product_name"];
				$savedPatientDrugs[$key]["product_guid"] = $value["product_guid"];
				$savedPatientDrugs[$key]["dosage_frequency"] = $value["dosage_frequency"];
				$savedPatientDrugs[$key]["duration_no"] = $value["duration_no"];
				$savedPatientDrugs[$key]["duration_frequency"] = $value["duration_frequency"];
				$savedPatientDrugs[$key]["total_qty"] = $value["total_qty"];
				$savedPatientDrugs[$key]["day_of_week"] = $value["day_of_week"];
				$savedPatientDrugs[$key]["created_dttm"] = $date[0];
			}
			$productIDArray[] = $value["product_guid"];
		} }
		
		$drugInteractions = $this->request->getData("drugInteractions");
		$savedPatientDrugs = json_encode($savedPatientDrugs);
		
		$email = new Email('default');
				$email->setFrom(['sahil@unikove.com' => 'Unikove']);
				$email->setTo($this->request->getData("email"));
				//$email->setTo("sahilranjan05@gmail.com");
				$email->viewBuilder()->setTemplate('drugsemail');
				$email->setEmailFormat('html');
				$email->setViewVars(['drugInteractions' => $drugInteractions, 'savedPatientDrugs' => $savedPatientDrugs]);
				$email->setSubject('Drugs Interaction');
				$email->send("");
	}
	
	public function getinventorydata()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$inventoryTable = TableRegistry::get('inventory_details');
						  
		$inventoryData = $inventoryTable->find()
						  ->select(["unit_price","qty_available","expiry_date","quantity","no_of_pack"])
						  ->where(["id"=>$this->request->getData("id")])
						  ->enableHydration(false)
						  ->first();
						  
		echo json_encode($inventoryData);
	}
	
	public function addorder()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$productsTable = TableRegistry::get('products');
		$orderFormTable = TableRegistry::get('order_form');
		$orderDetailsTable = TableRegistry::get('order_details');
		
		$productsData = $productsTable->find()->select(["id"])->where(["product_guid"=>$this->request->getData("orderproductGUID")])->enableHydration(false)->first();
		
		$orderFormData = $orderFormTable->find()->select(["id"])->where(["id"=>$this->request->getData("orderFormID")])->enableHydration(false)->first();
		
		if(empty($productsData))
		{
			//SAVE DATA IN 'products' TABLE
			$pData["pharmacy_id"] = 1;
			$pData["product_guid"] = $this->request->getData("orderproductGUID") ? $this->request->getData("orderproductGUID") : "";
			$pData["product_name"] = $this->request->getData("orderProductName") ? $this->request->getData("orderProductName") : "";
			$pData["product_desc"] = $this->request->getData("orderProductName") ? $this->request->getData("orderProductName") : "";
			$pData["created_dttm"] = date("Y-m-d H:i:s");
			$pData["modified_dttm"] = date("Y-m-d H:i:s");
			
			$pSave = $productsTable->newEntity($pData);
			$pSaveData = $productsTable->save($pSave);
			//SAVE DATA IN 'products' TABLE
		}
		
		if(empty($orderFormData))
		{
			//SAVE DATA IN 'order_form' TABLE
			$oFData["pharmacy_id"] = 1;
			$oFData["order_date"] = date("Y-m-d H:i:s");
			$oFData["order_name"] = $this->request->getData("orderName") ? $this->request->getData("orderName") : "";
			$oFData["order_status"] = 1;
			$oFData["created_dttm"] = date("Y-m-d H:i:s");
			$oFData["modified_dttm"] = date("Y-m-d H:i:s");
			
			$oFSave = $orderFormTable->newEntity($oFData);
			$oFSaveData = $orderFormTable->save($oFSave);
			//SAVE DATA IN 'order_form' TABLE
		}
		
		//SAVE DATA IN 'order_details' TABLE
		$oDTData["order_form_id"] = !empty($orderFormData) ? $orderFormData["id"] : $oFSaveData->id;
		$oDTData["product_id"] = !empty($productsData) ? $productsData["id"] : $pSaveData->id;
		$oDTData["quantity_ordered"] = $this->request->getData("orderProductQuantity") ? $this->request->getData("orderProductQuantity") : "";
		$oDTData["created_dttm"] = date("Y-m-d H:i:s");
		$oDTData["modified_dttm"] = date("Y-m-d H:i:s");
		
		$oDTSave = $orderDetailsTable->newEntity($oDTData);
		$oDTSaveData = $orderDetailsTable->save($oDTSave);
		//SAVE DATA IN 'order_details' TABLE
	}
	
	public function savePatitentRemarks()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$prTable = TableRegistry::get('patient_remarks');
		
		//SAVE DATA IN 'patient_remarks' TABLE
		$prData["users_id"] = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : "";
		$prData["patient_id"] = $this->request->getData("patient_id") ? $this->request->getData("patient_id") : "";
		$prData["remarks"] = $this->request->getData("remarks") ? $this->request->getData("remarks") : "";
		$prData["created_dttm"] = date("Y-m-d H:i:s");
		$prData["modified_dttm"] = date("Y-m-d H:i:s");
		
		$prSave = $prTable->newEntity($prData);
		$prSaveData = $prTable->save($prSave);
		
		$savedData = $prTable->find()->select(["id","remarks","created_dttm"])->where(["patient_id"=>$this->request->getData("patient_id")])->enableHydration(false)->toArray();
		
		if(!empty($savedData))
		{
			echo json_encode($savedData);
		}
		//SAVE DATA IN 'patient_remarks' TABLE
	}
	
	function getPatitentRemarks()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$prTable = TableRegistry::get('patient_remarks');
		
		$prData = $prTable->find()->select(["id","remarks","created_dttm"])->where(["patient_id"=>$this->request->getData("patient_id")])->enableHydration(false)->toArray();
		
		if(!empty($prData))
		{
			echo json_encode($prData);
		}
	}
	
	function deleteRemark()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$prTable = TableRegistry::get('patient_remarks');
		
		$prTable->deleteAll(['id'=>$this->request->getData("id")]);
	}
	
	public function getProductInventory()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$conn = ConnectionManager::get('default');
		
		if($this->request->getData("type")=="CIMS")
		{
			$explode = explode("_",$this->request->getData("product_guid"));
			
			$productGUID = $explode[0];
			
			$inventoryQuery = $conn->execute('select products.id AS productID, products.qty_in_pack, inventory_details.id, inventory_details.batch_no, inventory_details.unit_price, inventory_details.qty_available FROM products INNER JOIN inventory_details ON products.id = inventory_details.product_id WHERE products.product_guid="'.$productGUID.'"');
			
			$inventoryData = $inventoryQuery ->fetchAll('assoc');
		}
		else
		{
			$inventoryQuery = $conn->execute('select products.id AS productID, products.qty_in_pack, inventory_details.id, inventory_details.batch_no, inventory_details.unit_price, inventory_details.qty_available FROM products INNER JOIN inventory_details ON products.id = inventory_details.product_id WHERE products.id='.$this->request->getData("productID").'');
			$inventoryData = $inventoryQuery ->fetchAll('assoc');
		}
		
		echo json_encode($inventoryData);
	}
	
	public function getPatientPrescriptions()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$conn = ConnectionManager::get('default');
		
		$patientTable = TableRegistry::get('patient_details');
		
		$patientQuery = $conn->execute('select PPOI.product_name, PPOI.product_guid, PPOI.product_type, PPOI.dosage_frequency, PPOI.duration_no, PPOI.duration_frequency, PPOI.total_qty, PPOI.day_of_week, PPOI.created_dttm FROM pharmacy_prescription_order_items as PPOI INNER JOIN pharmacy_prescription ON pharmacy_prescription.id = PPOI.prescription_id WHERE pharmacy_prescription.patient_id='.$this->request->getData("patient_id"));
		$patientData = $patientQuery ->fetchAll('assoc');
		
		$productIDArray = array();
		$savedPatientDrugs = array();
		if(!empty($patientData)) {
		foreach(array_reverse($patientData) as $key => $value)
		{
			if(!in_array($value["product_guid"],$productIDArray))
			{
				$savedPatientDrugs[$key]["product_name"] = $value["product_name"];
				$savedPatientDrugs[$key]["product_guid"] = $value["product_guid"];
				$savedPatientDrugs[$key]["product_type"] = $value["product_type"];
				$savedPatientDrugs[$key]["dosage_frequency"] = $value["dosage_frequency"];
				$savedPatientDrugs[$key]["duration_no"] = $value["duration_no"];
				$savedPatientDrugs[$key]["duration_frequency"] = $value["duration_frequency"];
				$savedPatientDrugs[$key]["total_qty"] = $value["total_qty"];
				$savedPatientDrugs[$key]["day_of_week"] = $value["day_of_week"];
				$savedPatientDrugs[$key]["created_dttm"] = $value["created_dttm"];
			}
			$productIDArray[] = $value["product_guid"];
		} }
		
		$savedPatientAllergies = $patientTable->find()->select(["allergy"])->where(["id"=>$this->request->getData("patient_id")])->enableHydration(false)->first();
		
		$this->set(compact("savedPatientDrugs","savedPatientAllergies"));
		$this->render('/Element/Pharmacy/drugs_allergies');
	}
	
	
	public function getAvailableProducts()
	{
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
		
		$conn = ConnectionManager::get('default');
		
		$productData = !empty($this->request->getData("product_data")) ? json_decode($this->request->getData("product_data"),true) : "";
		
		if(!empty($productData))
		{
			foreach($productData as $key => $value)
			{
				$inventoryQuery = $conn->execute('select products.id AS product_id, inventory_details.id AS inventory_id FROM products INNER JOIN inventory_details ON products.id = inventory_details.product_id WHERE products.product_guid="'.$value["id"].'"');
				$inventoryData[] = $inventoryQuery ->fetch('assoc');
			}
		}
		
		if(!empty($productData))
		{
			foreach($productData as $productKey => $productValue)
			{
				foreach($inventoryData as $inventoryKey => $inventoryValue)
				{
					$finalData[$inventoryKey]["product_guid"] = $productData[$inventoryKey]["id"];
					$finalData[$inventoryKey]["product_name"] = $productData[$inventoryKey]["name"];
					$finalData[$inventoryKey]["product_id"] = $inventoryValue["product_id"] ? $inventoryValue["product_id"] : "";
					$finalData[$inventoryKey]["inventory_id"] = $inventoryValue["inventory_id"] ? $inventoryValue["inventory_id"] : "";
				}
			}
		}
		echo json_encode($finalData);
	}
	
}














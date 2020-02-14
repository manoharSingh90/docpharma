<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Mailer\Email;

class EmailerComponent extends Component
{
	 public function email($formData){
		 
	if(!empty($formData))
		{
		$email = new Email('default');
		$email->setFrom(['swati@unikove.com' => 'Unikove']);		
		$email->setTo($formData['email']);
	    $email->viewBuilder()->setTemplate('emailer');
        $email->setEmailFormat('html');
		$email->setViewVars(['name' => $formData['fname']]);
		$email->setAttachments(['photo.png' => ['file' => WWW_ROOT.'img/doctor/login_logo.png','mimetype' => 'image/png','contentId' => '12345']]);
		$email->setSubject('About');
		$email->send(); 
		echo "success";  
		}
		else{
			echo "error"; die; 
		}
	}
	
	public function executive_mail($formData){
		 
	if(!empty($formData))
		{
		$email = new Email('default');
		$email->setFrom(['swati@unikove.com' => 'Unikove']);		
		$email->setTo($formData['email']);
	    $email->viewBuilder()->setTemplate('emailer');
        $email->setEmailFormat('html');
		$email->setViewVars(['name' => $formData['first_name']]);
		$email->setAttachments(['photo.png' => ['file' => WWW_ROOT.'img/doctor/login_logo.png','mimetype' => 'image/png','contentId' => '12345']]);
		$email->setSubject('About');
		$email->send(); 
		echo "success";  
		}
		else{
			echo "error"; die; 
		}
	}
	
   public function inventory_mail($formData,$productData){
	   //pre($produc);
	if(!empty($formData))
		{
		$email = new Email('default');
		$email->setFrom(['swati@unikove.com' => 'Unikove']);		
		$email->setTo($formData['send_mail']);
		$email->viewBuilder()->setTemplate('inventory_mailer');
        $email->setEmailFormat('html');
		$email->setViewVars(['frmdta'=>$formData,'prod'=>$productData]); 
		$email->setAttachments(['photo.png' => ['file' => WWW_ROOT.'img/doctor/login_logo.png','mimetype' => 'image/png','contentId' => '12345']]);
		$email->setSubject('Order Forms');
		$email->send(); 
		echo "success";  
		}
		else{
			echo "error"; die; 
		}
	}
	
	 public function sheetUpload_mail($mail,$body){
	   //pre($produc);
	if(!empty($mail))
		{
		$email = new Email('default');
		$email->setFrom(['swati@unikove.com' => 'Unikove']);		
		$email->setTo($mail);
        $email->setEmailFormat('html');
		//$email->setViewVars(['frmdta'=>$formData,'prod'=>$productData]); 
		//$email->setAttachments(['photo.png' => ['file' => WWW_ROOT.'img/doctor/login_logo.png','mimetype' => 'image/png','contentId' => '12345']]);
		$email->setSubject('About Sheet');
		$email->send($body); 
		echo "success";  
		}
		else{
			echo "error"; die; 
		}
	}
}
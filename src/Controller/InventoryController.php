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
//use Cake\View\Helper\SessionHelper;
use Cake\View\View;
use App\View\Helper\urlHelper;
use Cake\Datasource\ConnectionManager;

class InventoryController extends AppController
{
   public function initialize()
    {
        parent::initialize();		
		$this->loadComponent('Emailer');
		
	 $role_id = $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : "";
	 $users_id = $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : ""; 
	 $clinic_id = $this->request->getSession()->read('clinic_id') ? $this->request->getSession()->read('clinic_id') : ""; 
	
		if(!$users_id){
		$this->redirect(['controller'=>'Login','action'=>'index']);
			}
	}
			
	public function index(){
		
	 $query = TableRegistry::get('inventory_details')->find()
	 ->enableHydration(false)
	 ->toArray();
		 
	 $produc = TableRegistry::get('products')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $manufact = TableRegistry::get('manufacturers')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $product_dosages = TableRegistry::get('product_dosages')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $orderForm = TableRegistry::get('order_form')->find()
	 ->enableHydration(false)
	 ->toArray();
	 //pre($manufact); die;
	  $con = ConnectionManager::get('default');	
	 
	  $productQuery = $con->execute('select products.product_name,products.qty_in_pack, products.qty_alert, manufacturers.manufacturer_name, product_dosages.dosages_type, inventory_details.id AS inventoryID, inventory_details.batch_no,inventory_details.location,inventory_details.expiry_date,inventory_details.no_of_pack,
	  inventory_details.quantity,inventory_details.unit_price FROM products INNER JOIN manufacturers ON products.manufacturer_id = manufacturers.id INNER JOIN product_dosages ON products.product_dosage_id = product_dosages.id INNER JOIN inventory_details ON inventory_details.product_id = products.id');
    
     $productData = $productQuery ->fetchAll('assoc');
	 //pre($productData); die; 
	 
	  $this->set(compact('query','produc','productData','orderForm'));
	}
	
	public function productManagement(){
		
	 $conn = ConnectionManager::get('default');	
	 $manufact = TableRegistry::get('manufacturers')->find()
	 ->enableHydration(false)
	 ->toArray();
	
	 //pre($manufact); die;
	 $product_type = TableRegistry::get('product_type')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $product_dosages = TableRegistry::get('product_dosages')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $produc = TableRegistry::get('products')->find('all',['order' => ['created_dttm' => 'DESC']])
	 ->enableHydration(false)
	 ->toArray();
	 
	$joinProductQuery = $conn->execute("SELECT products.id, products.is_active, products.product_name, products.qty_alert, products.qty_in_pack, manufacturers.id AS manuID, manufacturers.manufacturer_name, product_type.product_type_name, product_dosages.dosages_type FROM products INNER JOIN manufacturers ON manufacturers.id=products.manufacturer_id INNER JOIN product_type ON product_type.id=products.product_type_id INNER JOIN product_dosages ON product_dosages.id=products.product_dosage_id");
	$productTable = $joinProductQuery->fetchAll('assoc');
	//pre($productTable); die;
	 $this->set(compact('product_dosages','manufact','product_type','produc','productTable'));		
	 }
	
     public function searchData(){
	   
	 $manufact = TableRegistry::get('manufacturers')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 //pre($manufact); die;
	 $product_type = TableRegistry::get('product_type')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $product_dosages = TableRegistry::get('product_dosages')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $manufacturers = TableRegistry::get('manufacturers')->find()->where(["manufacturer_name LIKE"=>'%'.$_GET['value'].'%'])->enableHydration(false)->toArray();
	
	 $products = TableRegistry::get('products')->find()->where(["product_name LIKE"=>'%'.$_GET['value'].'%'])->enableHydration(false)->toArray();
	 $this->set(compact('products','manufacturers','product_dosages','manufact','product_type'));	
	 
	 ///pre($products); pre($manufacturers); 
	 if(!empty($products) || !empty($manufacturers)){		 
	  echo json_encode($this->render("/Element/Inventory/search_data"));
	  
	 }else{
	  echo json_encode($this->render("/Element/no_data"));
	 }
	  
     }
	 
	 public function checkDuplicate(){
		 //echo $_GET['value']; die;
	$products = TableRegistry::get('products')->find()->enableHydration(false)->toArray();
	//pre($products); die;
	foreach($products as $product){
		//echo $product['product_name']; echo '<br>';
		//echo $_GET['value'];
		if($product['product_name']==$_GET['value']){
			$msg = 'exist';
			echo json_encode($msg); 
		}
		
	  }die;
	 }
	 
	 public function disable(){
		 
	$formData = $this->request->getData();
    //pre($formData); die;	
	if($formData['value']==0) { 		  	 
	$producttbl = TableRegistry::get('products')->updateAll(['is_active'=>0,"reason"=>$formData['reason']],["id"=>$formData['id']]);
	}else{
	$producttbl = TableRegistry::get('products')->updateAll(['is_active'=>1],["id"=>$formData['id']]);
	}
	$this->Flash->set('Product Disabled Successfully. ', ['element' => 'success']);
	 echo $this->redirect(['controller'=>'inventory','action'=>'productManagement']);
	  }

     public function alphabets(){
	 
	 $this->autoRender=false;
	 $this->viewBuilder()->setLayout(false);
	 
	  $manufact = TableRegistry::get('manufacturers')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 //pre($manufact); die;
	 $product_type = TableRegistry::get('product_type')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $product_dosages = TableRegistry::get('product_dosages')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $products = TableRegistry::get('products')->find()->where(["product_name LIKE"=>$_GET['value'].'%'])->enableHydration(false)->toArray();
	  $this->set(compact('products','product_dosages','manufact','product_type'));
	 //pre($products); die;
	 if(!empty($products)){		 
	  echo json_encode($this->render("/Element/Inventory/search_by_alphabets"));
	  //die;
	 }else{
	  echo json_encode($this->render("/Element/no_data")); //die;
	 }
     }	
	 
	  public function all(){
		  
		$this->autoRender=false;
	 $this->viewBuilder()->setLayout(false);
	 
	  $manufact = TableRegistry::get('manufacturers')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 //pre($manufact); die;
	 $product_type = TableRegistry::get('product_type')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $product_dosages = TableRegistry::get('product_dosages')->find()
	 ->enableHydration(false)
	 ->toArray();  
		  
	 $products = TableRegistry::get('products')->find('all',['order' => ['created_dttm' => 'DESC']])->enableHydration(false)->toArray();
	  $this->set(compact('products','product_dosages','manufact','product_type'));
	 //pre($products); die;
	 if(!empty($products)){		 
	  echo json_encode($this->render("/Element/Inventory/search_by_all"));
	  //die;
	 }else{
	  echo json_encode($this->render("/Element/no_data")); //die;
	 }  
	  }
		 
	public function addProduct(){
	
	 $con = ConnectionManager::get('default');	
	 $formData = $this->request->getData();
	 $explodeProduct = explode('_',$formData['product_name']);
	 $formData['product_name'] = strtolower($explodeProduct[1]);
	 $formData['product_guid'] = $explodeProduct[0];
	 
	 if(filter_var($formData['manufacturer_id'], FILTER_VALIDATE_INT)){
		$formData['product_desc'] = strtolower($explodeProduct[1]);
		//pre($formData);  die;	
		$productsTable = TableRegistry::get('products');
		$products = $productsTable->newEntity($formData);
		$products = $productsTable->save($products);
	 }else{
	
		$form['manufacturer_name'] = $formData['manufacturer_id']; 
		$manuTable = TableRegistry::get('manufacturers');
		$manufacturer = $manuTable->newEntity($form);
		$manufacturer = $manuTable->save($manufacturer);
		echo $formData['manufacturer_id'] = $manufacturer->id;
		$formData['product_desc'] = $explodeProduct[1]; 
		//pre($formData); die;	
		$productsTable = TableRegistry::get('products');
		$products = $productsTable->newEntity($formData);
		$products = $productsTable->save($products); 
	 }
	 $this->Flash->set('The Data Successfully Submitted. ', ['element' => 'success']);
	return $this->redirect($this->referer());
	}
	
	public function editProduct($id=null){
		
	$formData = $this->request->getData();
		pre($formData); die;
	$productsTable = TableRegistry::get('products');
	$products = $productsTable->newEntity($formData);
	$products = $productsTable->save($products);
	
	$this->set(compact("products"));
	echo $this->redirect(["controller"=>"inventory","action"=>"productManagement"]);
	}
	 
	public function save(){
    
   $articlesTable = TableRegistry::get('inventory_details');
   $formData = $this->request->getData();
   //$formData['pharmacy_id']=$this->request->getSession()->read('users_id');
   $id = $formData['id'] ? $formData['id']:'';

   //pre($formData); die;
   $articlesTable->deleteAll(['id' => $id[0]]);
   foreach($formData["product_id"] as $key => $value)
   {
       $data["id"] = $id[$key];
       $data["product_id"] = $value;
       $data["batch_no"] = $formData["batch_no"][$key];
       $data["quantity"] = $formData["quantity"][$key];
       $data["expiry_date"] = $formData["expiry_date"][$key];
       $data["no_of_pack"] = $formData["no_of_pack"][$key];
       $data["qty_available"] = $formData["quantity"][$key];
       $data["unit_price"] = $formData["unit_price"][$key];
       $data["location"] = $formData["location"][$key];

       if($id[$key]=='' ){
       unset($data['id']); }
        //pre($id); die;
       $article = $articlesTable->newEntity($data);
       $article = $articlesTable->save($article);
	} 
	$this->Flash->set('The Data Successfully Submitted. ', ['element' => 'success']);
	echo $this->redirect(["controller"=>"inventory","action"=>"index"]);
	}
	
	public function createInventory($id=null){
	
   $con = ConnectionManager::get('default');
   
	$produc = TableRegistry::get('products')->find()
	 ->enableHydration(false)
	 ->toArray();	

	$query = TableRegistry::get('inventory_details');
	$data = $query->find()
				  ->select()
				  ->where(["id"=>$id])
				  ->enableHydration(false)					  
				  ->first();
				  
	 $productQuery = array();
     $productQuery = $con->execute("select products.product_name,products.qty_alert, products.qty_in_pack, manufacturers.manufacturer_name, product_dosages.dosages_type, inventory_details.id AS inventoryID, inventory_details.batch_no,inventory_details.location,inventory_details.expiry_date,inventory_details.no_of_pack,
	 inventory_details.quantity,inventory_details.unit_price FROM products INNER JOIN manufacturers ON products.manufacturer_id = manufacturers.id INNER JOIN product_dosages ON products.product_dosage_id = product_dosages.id INNER JOIN inventory_details ON inventory_details.product_id = products.id WHERE inventory_details.id='$id'");
    
     $productData = $productQuery ->fetchAll('assoc');
	 ///pre($productData); die;	
	 
	$this->set(compact("data",'produc','productData'));
	}
	
	public function manuname(){
		
	$produc = TableRegistry::get('products')->find()
	 ->where(["product_name"=>$_GET['value']])
	 ->enableHydration(false)
	 ->toArray(); 
	 
	 $manufact = TableRegistry::get('manufacturers')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $product_dosages = TableRegistry::get('product_dosages')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	  $product_id = $produc[0]['manufacturer_id']; 
	  $type = $produc[0]['product_dosage_id']; 
	 foreach($manufact as $manufa){
		if($manufa['id'] == $product_id){
		 $a['manu'] = $manufa['manufacturer_name'];		 
		  //echo json_encode($a);
	   }
	 }
	 foreach($product_dosages as $product_d){
	 if($product_d['id'] == $type){
		   $a['type'] = $product_d['dosages_type']; 
		  echo json_encode($a);
	  }
	 }
	  die;	
		
	}
	public function printInventorySheet(){
		
	$con = ConnectionManager::get('default');	
	
	 $query = TableRegistry::get('inventory_details')->find()
	 ->enableHydration(false)
	 ->toArray();
		 
	 $produc = TableRegistry::get('products')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 //$productQuery = array();
	 $productQuery = $con->execute('select products.product_name, manufacturers.manufacturer_name, product_dosages.dosages_type, inventory_details.id AS inventoryID, inventory_details.batch_no,inventory_details.location,inventory_details.expiry_date,
	 inventory_details.quantity,inventory_details.no_of_pack FROM products INNER JOIN manufacturers ON products.manufacturer_id = manufacturers.id INNER JOIN product_dosages ON products.product_dosage_id = product_dosages.id INNER JOIN inventory_details ON inventory_details.product_id = products.id');
    
     $productData = $productQuery ->fetchAll('assoc');
	 //pre($productData); die;
	 
	  $this->set(compact('query','produc','productData'));	
	}

     public function allbet(){
		  
	 $this->autoRender=false;
	 $this->viewBuilder()->setLayout(false);
	 
	  $manufact = TableRegistry::get('manufacturers')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 //pre($manufact); die;
	 $product_type = TableRegistry::get('product_type')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	  $products = TableRegistry::get('products')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $product_dosages = TableRegistry::get('product_dosages')->find()
	 ->enableHydration(false)
	 ->toArray();  
		  
	 $inventory = TableRegistry::get('inventory_details')->find('all',['order' => ['created_dttm' => 'DESC']])->enableHydration(false)->toArray();
	 $this->set(compact('inventory','product_dosages','manufact','product_type','products'));
	 //pre($products); die;
	 if(!empty($products)){		 
	  echo json_encode($this->render("/Element/Inventory/all_inventory"));
	  //die;
	 }else{
	  echo json_encode($this->render("/Element/no_data")); //die;
	 }  
	  }	
	
	public function findManufac(){
		
	//echo $_GET['value']; die;
	$produc = TableRegistry::get('products')->find()
	 ->where(["id"=>$_GET['value']])
	 ->enableHydration(false)
	 ->toArray(); 
	 //pre
	 $manufact = TableRegistry::get('manufacturers')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $product_dosages = TableRegistry::get('product_dosages')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	  $product_id = isset($produc[0]['manufacturer_id'])?$produc[0]['manufacturer_id']:''; 
	  $type = isset($produc[0]['product_dosage_id'])?$produc[0]['product_dosage_id']:''; 
	  $qty_in_pack = isset($produc[0]['qty_in_pack'])?$produc[0]['qty_in_pack']:''; 
	 foreach($manufact as $manufa){
		if($manufa['id'] == $product_id){
		 $a['manu'] = $manufa['manufacturer_name'];		 
		 $a['qty_in_pack'] = $produc[0]['qty_in_pack'];		 
		  //echo json_encode($a);
	   }
	 }
	 foreach($product_dosages as $product_d){
	 if($product_d['id'] == $type){
		   $a['type'] = $product_d['dosages_type']; 
		  echo json_encode(isset($a)?$a:'');
	  }
	 }
	  die;
	}
	
	public function orderForm()
	{	
	 $con = ConnectionManager::get('default');	
	 $produc = TableRegistry::get('products')->find()
			  ->enableHydration(false)
			  ->toArray();
			  
	$orderForm = TableRegistry::get('order_form')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $productQuery = $con->execute("select order_details.quantity_ordered,order_details.id as orderDetailsID,order_form.id as orderFormID FROM order_details INNER JOIN order_form ON order_details.order_form_id = order_form.id");
	 $productData = $productQuery ->fetchAll('assoc');
	 //pre($productData); die;
	 $this->set(compact("orderForm",'produc','productData'));
	}
	
	public function sendMail() {
		
	$con = ConnectionManager::get('default');	
	$produc = TableRegistry::get('products')->find()
              ->enableHydration(false)
              ->toArray();
	
	$formData = $this->request->getData();	
	$formData['send_mail'] = $_POST['send_mail'];
	$id = $formData['id'];
	//pre($formData); die;
    $productQuery = $con->execute("select products.product_name,products.id as ProductID,products.qty_in_pack, manufacturers.manufacturer_name, product_dosages.dosages_type, order_details.quantity_ordered,order_details.num_of_pack,order_details.id as order_detailsID FROM products INNER JOIN manufacturers ON products.manufacturer_id = manufacturers.id INNER JOIN product_dosages ON products.product_dosage_id = product_dosages.id INNER JOIN order_details on products.id = order_details.product_id WHERE order_details.order_form_id='$id'");
	
   $productData = $productQuery ->fetchAll('assoc');
   $this->set(compact('productData'));
	//pre($formData);	die;
    $this->Emailer->inventory_mail($formData,$productData);	
   $this->redirect($this->referer());
	}
	
	public function printSheet($slug=null){
	
	$con = ConnectionManager::get('default');	
	$produc = TableRegistry::get('products')->find()
			->enableHydration(false)
			->toArray();
			  
	 $orderForm = TableRegistry::get('order_form')->find()
	 ->where(["slug"=>$slug])
	 ->enableHydration(false)
	 ->toArray();
	//pre($orderForm[0]['id']); die;
	 $id = $orderForm[0]['id'];
	 $productQuery = $con->execute("select products.product_name,products.id as ProductID,products.qty_in_pack, manufacturers.manufacturer_name, product_dosages.dosages_type, order_details.quantity_ordered, order_details.num_of_pack, order_details.id as order_detailsID FROM products INNER JOIN manufacturers ON products.manufacturer_id = manufacturers.id INNER JOIN product_dosages ON products.product_dosage_id = product_dosages.id INNER JOIN order_details on products.id = order_details.product_id WHERE order_details.slug='$slug'");
	
	$productData = $productQuery ->fetchAll('assoc');
	 
	/* $productID = explode(",",$orderForm[0]["product_id"]);
	$productQuery = array();
	foreach($productID as $key => $value)
	{
		$productQuery = $con->execute("select products.product_name, manufacturers.manufacturer_name, product_dosages.dosages_type FROM products INNER JOIN manufacturers ON products.manufacturer_id = manufacturers.id INNER JOIN product_dosages ON products.product_dosage_id = product_dosages.id WHERE products.id='$value'");
		$productData[] = $productQuery ->fetch('assoc');
	} */
	// pre($productData); die;
	 
	$this->set(compact("orderForm",'produc','productData')); 
	} 
	
	public function saveOrderForm(){
	
	$order_detailTable = TableRegistry::get('order_details');
	$formData = $this->request->getData();
	//pre($formData); die;
	if(function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
     }
	echo $formValue['id']=$formData['orderForm_id']?$formData['orderForm_id']:''; echo '<br>'; 
	//$formValue['pharmacy_id']=$this->request->getSession()->read('users_id'); 
	$formValue['order_date'] = date("Y-m-d g:i:s");
	$formValue['order_name'] =  lcfirst($formData['order_name']);  
	$formValue['slug'] = preg_replace('/[^A-Za-z0-9-]+/', '-', lcfirst($formData['order_name']));  
	//pre($formData); die; 
	$order_formTable = TableRegistry::get('order_form');
	$order_form = $order_formTable->newEntity($formValue);
	$order_form = $order_formTable->save($order_form);	
	
	echo $form['order_form_id'] = $order_form->id; echo '<br>'; 
	//pre($formData["num_of_pack"]); pre($formData["quantity_ordered"]); die;
	$order_detail_id = $formData['order_detail_id']?$formData['order_detail_id']:'';
	$order_detailTable->deleteAll(['id' => $order_detail_id[0]]);
    foreach($formData['product_id'] as $key => $value)
    {
       $data["id"] = $order_detail_id[$key];
       $data["order_form_id"] = $form['order_form_id'];
       $data["slug"] = $formValue['slug'];
       $data["product_id"] = $value;
       $data["num_of_pack"] = $formData["num_of_pack"][$key];       
       $data["quantity_ordered"] = $formData["quantity_ordered"][$key];       
      //pre($data); die;
       if($order_detail_id[$key]=='' ){                  
       unset($data['id']); }
       
	$order_detail = $order_detailTable->newEntity($data);
	$order_detail = $order_detailTable->save($order_detail);
	} 
	
	$produc = TableRegistry::get('products')->find()
	 ->enableHydration(false)
	 ->toArray();
	$this->set(compact('produc'));
	 $this->Flash->set('The Data Successfully Submitted.', ['element' => 'success']);
	echo $this->redirect(["controller"=>"inventory","action"=>"orderForm"]);
	}
	
	public function searchData3(){
	
	 $order_form = TableRegistry::get('order_form')->find()->where(["order_name LIKE"=>'%'.$_GET['value'].'%'])->enableHydration(false)->toArray();
	 $this->set(compact('order_form'));	
	 
	 ///pre($products); pre($manufacturers); 
	 if(!empty($order_form)){		 
	  echo json_encode($this->render("/Element/Inventory/order_form"));
	  
	 }else{
	  echo json_encode($this->render("/Element/no_data"));
	 }
	  
     }
	
	public function createOrderForm($slug=null){
	
    $con = ConnectionManager::get('default');	
	$produc = TableRegistry::get('products')->find()
	 ->enableHydration(false)
	 ->toArray(); 
	 
	$query = TableRegistry::get('order_form');
	$data = $query->find()
				  ->select()
				  ->where(["slug"=>$slug])
				  ->enableHydration(false)					  
				  ->first();
				  
	$productQuery = $con->execute("select products.product_name,products.id as ProductID,products.qty_in_pack, manufacturers.manufacturer_name, product_dosages.dosages_type,order_details.quantity_ordered,order_details.num_of_pack, order_details.id as order_detailsID FROM products INNER JOIN manufacturers ON products.manufacturer_id = manufacturers.id INNER JOIN product_dosages ON products.product_dosage_id = product_dosages.id INNER JOIN order_details on products.id = order_details.product_id WHERE order_details.slug='$slug'");
	
	$productData = $productQuery ->fetchAll('assoc');
	//pre($productData); die;
	/* $productID = explode(",",$data["product_id"]);
	
	$productQuery = array();
	foreach($productID as $key => $value)
	{
		$productQuery = $con->execute("select products.product_name,products.qty_in_pack, manufacturers.manufacturer_name, product_dosages.dosages_type FROM products INNER JOIN manufacturers ON products.manufacturer_id = manufacturers.id INNER JOIN product_dosages ON products.product_dosage_id = product_dosages.id WHERE products.id='$value'");
		$productData[] = $productQuery ->fetch('assoc');
	} */
	//pre($productData); die;			  
	$this->set(compact("data",'produc','productData'));
	
	}
	
	public function deleteOrderForm(){
	
	$formData = $this->request->getData();
	//echo $formData['id']; die;
	$data = TableRegistry::get('order_form')->get($formData['id']);	
	$result = TableRegistry::get('order_form')->delete($data);
	 $this->Flash->set('The Data Successfully Deleted.', ['element' => 'success']);
	echo $this->redirect(["controller"=>"inventory","action"=>"orderForm"]);
    }
			
	public function viewOrderForm($slug=null){
		
	$con = ConnectionManager::get('default');		
	$produc = TableRegistry::get('products')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	$query = TableRegistry::get('order_form');
	$data = $query->find()
				  ->select()
				  ->where(["slug"=>$slug])
				  ->enableHydration(false)					  
				  ->first();
				  
	$productQuery = $con->execute("select products.product_name,products.qty_in_pack, manufacturers.manufacturer_name, products.id AS productID, product_dosages.dosages_type, order_details.quantity_ordered, order_details.num_of_pack,order_details.id FROM products INNER JOIN manufacturers ON products.manufacturer_id = manufacturers.id INNER JOIN product_dosages ON products.product_dosage_id = product_dosages.id INNER JOIN order_details on products.id = order_details.product_id WHERE order_details.slug='$slug'");
	$productData = $productQuery ->fetchAll('assoc');
	//pre($productData); die;
	
	/* $productID = explode(",",$data["product_id"]);
	
	$productQuery = array();
	foreach($productID as $key => $value)
	{
		$productQuery = $con->execute("select products.product_name,products.qty_in_pack, manufacturers.manufacturer_name, product_dosages.dosages_type FROM products INNER JOIN manufacturers ON products.manufacturer_id = manufacturers.id INNER JOIN product_dosages ON products.product_dosage_id = product_dosages.id WHERE products.id='$value'");
		$productData[] = $productQuery ->fetch('assoc');
	}
	// pre($productData); die; */
		
	$this->set(compact("data",'produc','productData')); 
	}

    public function deleteOrder(){
	
	$formData = $this->request->getData();
	//echo $formData['id']; die;
	$data = TableRegistry::get('order_details')->get($formData['id']);	
	$result = TableRegistry::get('order_details')->delete($data);
	$this->Flash->set('The Data Successfully Deleted.', ['element' => 'success']);
	$this->redirect($this->referer());
    }
	
	public function editOrderForm($id=null){
		
	$formData = $this->request->getData();
	//pre($formData); die;
	$order_formTable = TableRegistry::get('order_details');
	$order_form = $order_formTable->newEntity($formData);
	$order_form = $order_formTable->save($order_form);
	//pre($formData); die;
	 $this->Flash->set('The Data Successfully Submitted.', ['element' => 'success']);
	$this->redirect($this->referer());
	}
	
	public function loadMore(){
		
	$product_type = TableRegistry::get('product_type')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $manufact = TableRegistry::get('manufacturers')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
	 $product_dosages = TableRegistry::get('product_dosages')->find()
	 ->enableHydration(false)
	 ->toArray(); 
	 
	$this->loadModel('inventory_details');	  
    $list = $this->inventory_details
	->find()
	->order(['id'=>'ASC'])
	->limit(1)->enableHydration(false)->toArray();
       
	$this->set(compact('list','product_type','manufact','product_dosages'));
	//$this->render("/Element/Patient/alphabetical_order");
	
	if(!empty($list)){		 
	  echo json_encode($this->render("/Element/Inventory/loadmore"));
	  //die;
	 }else{
	  echo json_encode($this->render("/Element/no_data")); //die;
	 } 
	} 
	
	public function targetUpload(){
		
	 $producTable = TableRegistry::get('products')->find()
	 ->enableHydration(false)
	 ->toArray();	
		
	$con = ConnectionManager::get('default');	
	$this->loadModel('manufacturers');
	//$pharmacy_id = $this->request->getSession()->read('users_id');
    $uploaded = $this->request->getData();
    //print_r($_FILES); print_r($uploaded); die;

        if($_FILES)
        {

            $chkError=0;
            $errorData=array();
            $MediaName = $_FILES['upload_sheet']['name'];
            $MediaTempName     = $_FILES['upload_sheet']['tmp_name'];
            $MediaExtension = pathinfo($MediaName, PATHINFO_EXTENSION);
            $MediaNewName    = date("YmdHis").'.'.$MediaExtension;
            $filePath         = WWW_ROOT .'files/';
            $fileNewPath         = $filePath.$MediaNewName;
			move_uploaded_file($MediaTempName, $fileNewPath);
            $MediaNewName = str_replace(' ','',$MediaNewName);
           
            /*Save Exl to data base start*/

           $this->viewBuilder()->setLayout(false);
			require_once(ROOT . DS  . 'vendor' . DS  . 'PHPExcel' . DS . 'Classes' . DS . 'PHPExcel' . DS . 'IOFactory.php');
			
			$objPHPExcel =  PHPExcel_IOFactory::load(WWW_ROOT.'files/'.$MediaNewName);
			$objWorksheet = $objPHPExcel->getSheet(0);
		  
            $highest_row = $objWorksheet->getHighestRow();
            $highest_col = $objWorksheet->getHighestColumn();
			 //echo $highest_col;die;
            $header_row = $objWorksheet->rangeToArray('A1:AX1');
			//pre($header_row); die;
			$totalRows=0;$totalSuccess=0;$totalError=0;
			if($header_row[0][0]!='Product Name' || $header_row[0][0]==''|| $header_row[0][1]!='Product Desc' || $header_row[0][1]=='' || $header_row[0][2]!='Manufacturer' || $header_row[0][2]=='' || $header_row[0][3]!='Product Type' || $header_row[0][3]=='' || $header_row[0][4]!='Qty In Pack' || $header_row[0][4]=='' || $header_row[0][5]!='Product Dosages' || $header_row[0][5]=='' || $header_row[0][6]!='Qty Alert' || $header_row[0][6]=='')
			{
				$msg['msg']='Invalid!! Please correct your excel sheet.';
				echo json_encode($msg);
				unlink(WWW_ROOT .'files/'.$MediaNewName); die;
			}
			else
			{ 	
			$m=1;$n=1;$unsuccess='';$success='';
			$count_team=0;$memb=array();
            $counter=1;
		    $row = $objWorksheet->rangeToArray('A'.$counter.':'.$highest_col.$counter);
		    //pre($row);die;   

                for($counter = 2; $counter <= $highest_row; $counter++)
                {
					$totalRows=$totalRows+1;
                    $chkrowError=0;
                    $row = $objWorksheet->rangeToArray('A'.$counter.':'.$highest_col.$counter);
                    //pre($row);die; 
                    $product_name      =     trim($row[0][0]);
                    $product_desc      =     trim($row[0][1]);
                    $manufacturer_id   =     trim($row[0][2]);
                    $product_type_id   =     trim($row[0][3]);
                    $qty_in_pack       =     trim($row[0][4]);
                    $product_dosage_id =     trim($row[0][5]);
                    $qty_alert         =     trim($row[0][6]);
                      
					 $data1= $this->get_id('manufacturers',$manufacturer_id,'manufacturer_name');
                     $data2= $this->get_id('product_type',$product_type_id,'product_type_name'); 
                     $data3= $this->get_id('product_dosages',$product_dosage_id,'dosages_type'); 
					
					$otherError=0;
					$ErrorColun='';
                   foreach($producTable as $producTab){					  
                    if($product_name==$producTab['product_name']){						 
					   /* $otherError=1;
					   $ErrorColun='Product Name'; */
					   $msg['msg']=$product_name.' '.'Product Name Already Exists!!';
				       echo json_encode($msg); unlink(WWW_ROOT .'files/'.$MediaNewName); die; 
					
					 }
                    }														
					 												
						if($product_name=='' || $product_desc=='' || $qty_alert=='' || $qty_in_pack=='' || $manufacturer_id=='' || $product_type_id=='' || $product_dosage_id=='' || $otherError==1){
												
					    if($product_name==''){
						$msg['msg']='Product Name can not be blank';
						echo json_encode($msg);}
						else if($product_desc==''){
						$msg['msg']='Product Desc can not be blank';
					    echo json_encode($msg); }
						else if($qty_alert==''){
						$msg['msg']='Qty Alert can not be blank';
					    echo json_encode($msg); }
						else if($qty_in_pack==''){
						$msg['msg']='Qty In Pack can not be blank';
					    echo json_encode($msg); }
						else if($manufacturer_id==''){
						$msg['msg']='Manufacturer Name can not be blank';
					    echo json_encode($msg); }
						else if($product_type_id==''){
						$msg['msg']='Product Type can not be blank';
					    echo json_encode($msg); }
						else if($product_dosage_id==''){
						$msg['msg']='Product Dosages can not be blank';
					    echo json_encode($msg); }
						unlink(WWW_ROOT .'files/'.$MediaNewName); die;
						}
						
					if(!filter_var($qty_alert, FILTER_VALIDATE_INT)){
					   /* $otherError=1;
					   $ErrorColun='Qty Alert'; */
					   $msg['msg']='Quantity Alert Should be Integer';
				       echo json_encode($msg); unlink(WWW_ROOT .'files/'.$MediaNewName); die;
					  }
						
					if(!filter_var($qty_in_pack, FILTER_VALIDATE_INT)){				      
				       /* $otherError=1;
					   $ErrorColun='Qty In pack'; */
					   $msg['msg']='Quantity In Pack Should be Integer';
				       echo json_encode($msg); unlink(WWW_ROOT .'files/'.$MediaNewName); die;
				       }
					  					
					if($data2==null){						
						/* $otherError=1;
					    $ErrorColun='Product Type'; */
						$msg['msg']=$product_type_id.'-'.'Please Fill Correct Product Type!!';
				        echo json_encode($msg); unlink(WWW_ROOT .'files/'.$MediaNewName); die;
					    } 
						
					if($data3==null){
						/* $otherError=1;
					    $ErrorColun='Product Dosages'; */
						$msg['msg']=$product_dosage_id.'-'.'Please Fill Correct Product Dosages!!';
				         echo json_encode($msg); unlink(WWW_ROOT .'files/'.$MediaNewName); die;
					    }

						
					/* if($product_name=='' || $product_desc=='' || $qty_alert=='' || $qty_in_pack=='' || $manufacturer_id=='' || $product_type_id=='' || $product_dosage_id=='' || $otherError==1){
						
						$chkError=1;$chkrowError=1;
						$totalError=$totalError+1;
					    if($product_name=='')
						$ErrorColun='Product Name';
						else if($product_desc=='')
						$ErrorColun='Product Desc';
						else if($qty_alert=='')
						$ErrorColun='Qty Alert';
						else if($qty_in_pack=='')
						$ErrorColun='Qty In Pack';
						else if($manufacturer_id=='')
						$ErrorColun='Manufacturer Name';
						else if($product_type_id=='')
						$ErrorColun='Product Type';
						else if($product_dosage_id=='')
						$ErrorColun='Product Dosages';
												
						$errorData[$counter]['product_name']=$product_name;
						$errorData[$counter]['product_desc']=$product_desc;
						$errorData[$counter]['qty_alert']=$qty_alert;
						$errorData[$counter]['qty_in_pack']=$qty_in_pack;
						$errorData[$counter]['manufacturer_id']=$manufacturer_id;
						$errorData[$counter]['product_type_id']=$product_type_id;
						$errorData[$counter]['product_dosage_id']=$product_dosage_id;
						
					} */
					
                    if($chkrowError==0)
                    {
						$totalSuccess=$totalSuccess+1;
	 	            	if(!$data1==null){
					    $products['manufacturer_id']= $data1[0]['id'];
					    }
						else{							
						$manufact['manufacturer_name'] =  $manufacturer_id;
						$manuTable = TableRegistry::get('manufacturers');
						$manufact = $manuTable->newEntity($manufact);
						$manufact = $manuTable->save($manufact);
						$products['manufacturer_id'] = $manufact->id;
						}
						
                        $products['product_name']=$product_name;
                        $products['product_desc']=$product_desc;                            
                        $products['qty_alert']=$qty_alert;
                        $products['qty_in_pack']=$qty_in_pack;                       
                        $products['product_type_id']= $data2[0]['id'];
                        $products['product_dosage_id']= $data3[0]['id'];
                        
                         //pre($products); die;
                        $productTable = TableRegistry::get('products');
						$product = $productTable->newEntity($products);
						$product = $productTable->save($product);
                        //pre($products);die;
                        $row = reset($row);
						unlink(WWW_ROOT .'files/'.$MediaNewName);
                    }
						
                }
               //unlink(WWW_ROOT .'files/'.$MediaNewName);
			 
			 if($chkError==0)
			{
				
				$body='<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0" /><title>Arise</title><style type="text/css">
				.ExternalClass {width: 100%;}.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}body {-webkit-text-size-adjust: none;-ms-text-size-adjust: none;}body{margin: 0;padding: 0;}
				body, #body_style {width: 100% !important;min-height: inherit;color: #3c4556;background: #fff;
				font-family: Arial, Helvetica, sans-serif;font-size: 13px;line-height: 1.4;}
				table {
					border-spacing: 0;
				}
				table td {
					border-collapse: collapse;
				}
				p {
					margin: 0;
					padding: 0;
					margin-bottom: 0;
				}
				img {
					display: block;
					border: none;
					outline: none;
					text-decoration: none;
				}
				table {
					border-collapse: collapse;
					mso-table-lspace: 0pt;
					mso-table-rspace: 0pt;
				}

				/****** MEDIA QUERIES ********/
				@media only screen and (max-width: 639px) {
				body[yahoo] .hide {
					display: none !important;
				}
				body[yahoo] .mobiwide {
					width: 25px !important;
				}
				body[yahoo] .table {
					width: 320px !important;
				}
				body[yahoo] .innertable {
					width: 280px !important;
				}
				body[yahoo] .changeColor {
					color: #505E6D;
					font-size: 9px;
				}
				body[yahoo] .fontSize {
					font-size: 12px !important;
				}
				}
				</style>
				</head>

				<body style="width:100% !important; color:#3c4556; background:#fff; font-family:Arial,Helvetica,sans-serif; font-size:14px; line-height:1.4;" bgcolor="#fff" yahoo="fix">
				<div id="body_style">
				  <table cellpadding="0" cellspacing="0" border="0" align="center" style="width:100% !important; margin:0; padding:0;">
					<tr bgcolor="#fff" class="hide">
					  <td><table width="552" cellpadding="2" cellspacing="0" border="0" align="center" class="table">
						  <tr>
							<td>&nbsp;</td>
						  </tr>
						</table></td>
					</tr>
					<tr bgcolor="#fff">
					  <td>
						  <table width="552" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#fff" class="table">
						  <tr>
							<td>
								<table width="100%" cellpadding="2" cellspacing="0" border="0" bgcolor="#fff">
								<tr>
								  <td align="center"><img src="'.WWW_ROOT.'img/doctor/login_logo.png" border="0" alt="Docpharma" style="border:none; display:block; margin-left: 5px;"/></td>
								</tr>
							  </table>
							  </td>
						  </tr>
							  
							  
						  <tr>
							<td><table width="100%" cellpadding="0" cellspacing="0" border="0"  bgcolor="#fff">
								<tr>
								  <td style="border-bottom: 1px solid #ddd;">&nbsp;</td>
								  <td align="left" valign="top"  style="border-bottom: 1px solid #ddd;"></td>
								  <td  style="border-bottom: 1px solid #ddd;">&nbsp;</td>
								</tr>
							  </table></td>
						  </tr>
						  <tr>
							<td><table width="100%" cellpadding="0" cellspacing="0" border="0"  bgcolor="#fff">
								<tr>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td align="center"><img src="'.WWW_ROOT.'img/success.jpg" border="0" alt="Docpharma" style="border:none; display:block; margin-left: 5px;"/></td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td style="font-size: 28px; text-align: center; font-weight: 100; color: #4c4c4c;">Data has been successfully extracted<br>from the Uploaded Document!</td>
								</tr>
							  </table></td>
						  </tr>
						 
						  <tr>
							<td><table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
								  <td style="padding:5px;"></td>
								</tr>
								<tr>
								  <td style="padding:5px;"></td>
								</tr>
								<tr>
								  <td style="padding:5px; border-top: 1px solid #ddd;"></td>
								</tr>
								<tr>
								  <td style="padding:5px;"></td>
								</tr>
								<tr>
								  <td style="color: #646262; font-size: 18px; " align="center">The uploaded document is attached to the mail for your reference.</td>
								</tr>
							  </table></td>
						  </tr>
						</table></td>
					</tr>
					  <tr bgcolor="#fff" class="hide">
					  <td><table width="552" cellpadding="2" cellspacing="0" border="0" align="center" class="table">
						  <tr>
							<td>&nbsp;</td>
						  </tr>
						</table></td>
					</tr>
				  </table>
				</div>
				</body>
				</html>';
				
		   $mail = $this->request->getSession()->read('emailID'); 
		   $this->Emailer->sheetUpload_mail($mail,$body);
				
			}
			/* else{
				
				$fileName = "inventory_sheet.xlsx";				
			    $objPHPExcel = new PHPExcel(); 			  
				$this->response->withDownload($fileName);
				$row=1;
				$objPHPExcel->getActiveSheet(0)
						->setCellValue('A'.$row,'Product Name')
						->setCellValue('B'.$row, 'Batch No')
						->setCellValue('C'.$row, 'Unit Price')
						->setCellValue('D'.$row, 'Qty Available')
						->setCellValue('E'.$row, 'Expiry Date')
						->setCellValue('E'.$row, 'Location')
						->setCellValue('F'.$row, 'InvalidColumn');
						
				$row2=2;
				
				foreach($errorData as $ct){ 
					
					$objPHPExcel->getActiveSheet(1)
					->setCellValue('A'.$row2, "".$ct['Product Name']."")
					->setCellValue('B'.$row2,"".$ct['Batch No']."")
					->setCellValue('C'.$row2, "".$ct['Unit Price']."")
					->setCellValue('D'.$row2, "".$ct['Qty Available']."")
					->setCellValue('E'.$row2,"".$ct['Expiry Date']."")
					->setCellValue('E'.$row2,"".$ct['Location']."")
					->setCellValue('F'.$row2, "".$ct['InvalidColumn']."");
					$row2++	;
				}
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header("Content-Disposition: attachment;filename=\"$fileName\"");
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$filePath 		= WWW_ROOT .'files/';
				unlink($filePath.$fileName);
				$objWriter->save($filePath.$fileName);		
				ob_clean();
				ob_end_flush();
			}
			 */
            $msg['msg']='Data Uploaded Successfully!!';
			//$msg['totalrows']=$totalRows;
			//$msgq['tsuccess']=$totalSuccess;
			//$msgq['terror']=$totalError;
			echo json_encode($msg); die;
        }
	  }
	  echo $this->redirect(["controller"=>"inventory","action"=>"productManagement"]);
	}
	  
    public function sheetUpload(){
	   		
    $producTable = TableRegistry::get('products')->find()
	 ->enableHydration(false)
	 ->toArray();
	 
    $uploaded = $this->request->getData();

        if($_FILES)
        {
            $chkError=0;
            $errorData=array();
            $MediaName = $_FILES['upload_sheet']['name'];
            $MediaTempName     = $_FILES['upload_sheet']['tmp_name'];
            $MediaExtension = pathinfo($MediaName, PATHINFO_EXTENSION);
            $MediaNewName    = date("YmdHis").'.'.$MediaExtension;
            $filePath         = WWW_ROOT .'files/';
            $fileNewPath         = $filePath.$MediaNewName;
			move_uploaded_file($MediaTempName, $fileNewPath);
            $MediaNewName = str_replace(' ','',$MediaNewName);
  
            /*Save Exl to data base start*/

            $this->viewBuilder()->setLayout(false);
			require_once(ROOT . DS  . 'vendor' . DS  . 'PHPExcel' . DS . 'Classes' . DS . 'PHPExcel.php');
			require_once(ROOT . DS  . 'vendor' . DS  . 'PHPExcel' . DS . 'Classes' . DS . 'PHPExcel' . DS . 'IOFactory.php');
			
			$objPHPExcel =  PHPExcel_IOFactory::load(WWW_ROOT.'files/'.$MediaNewName);
			//pre($objPHPExcel);die;
			$objWorksheet = $objPHPExcel->getSheet(0);
		  
            $highest_row = $objWorksheet->getHighestRow();
            $highest_col = $objWorksheet->getHighestColumn();
			 //echo $highest_col;die;
            $header_row = $objWorksheet->rangeToArray('A1:AX1');
			//pre($header_row); die;
			$totalRows=0;$totalSuccess=0;$totalError=0;
			if($header_row[0][0]!='Product Name' || $header_row[0][0]=='' || $header_row[0][1]!='Batch No' || $header_row[0][1]==''|| $header_row[0][2]!='Expiry Date' || $header_row[0][2]=='' || $header_row[0][3]!='No Of Pack' || $header_row[0][3]==''|| $header_row[0][4]!='Total Quantity' || $header_row[0][4]=='' || $header_row[0][5]!='Per Pack Price' || $header_row[0][5]=='' || $header_row[0][6]!='Shelf Location' || $header_row[0][6]=='' )
			{
				$msg['msg']='Invalid!! Please correct your excel sheet.';
				echo json_encode($msg);die;
			}
			else
			{ 	
				$m=1;$n=1;$unsuccess='';$success='';
				$count_team=0;$memb=array();
				$counter=1;
				$row = $objWorksheet->rangeToArray('A'.$counter.':'.$highest_col.$counter);
				//pre($row);die;   

                for($counter = 2; $counter <= $highest_row; $counter++)
                {
					$totalRows=$totalRows+1;
                    $chkrowError=0;
                    $row = $objWorksheet->rangeToArray('A'.$counter.':'.$highest_col.$counter);
                    // pre($row);die; 
                    $product_name     =     trim($row[0][0]);
                    $batch_no         =     trim($row[0][1]);
                    $expiry_date       =     trim($row[0][2]);
                    $no_of_pack        =     trim($row[0][3]);
                    $total_quantity      =     trim($row[0][4]);
                    $per_pack_price   =     trim($row[0][5]);
                    $location         =     trim($row[0][6]);
     
	                $otherError=0;
					$ErrorColun='';
                    $data1= $this->get_id('products',$product_name,'product_name');
					//pre($data1[0]['id']); die;
					
					if($data1==null){				    
					   /*  $otherError=1;
						$ErrorColun='Product Name'; */
					$msg['msg']=$product_name.' '."This Product Doesn't Exists!! Please Fill a valid product";
				      echo json_encode($msg); unlink(WWW_ROOT .'files/'.$MediaNewName); die;
					} 
																
					 if($product_name=='' || $batch_no=='' || $no_of_pack=='' || $per_pack_price=='' || $expiry_date=='' || $total_quantity=='' || $location=='' || $otherError==1)
					 {
					  if($product_name==''){
						$msg['msg']='Product Name can not be blank';
					    echo json_encode($msg); 
						}
						else if($batch_no==''){
						$msg['msg']='Batch No can not be blank'; 
					    echo json_encode($msg); }
						else if($no_of_pack==''){
						$msg['msg']='No Of Pack can not be blank'; 
					    echo json_encode($msg); }
						else if($per_pack_price==''){
						$msg['msg']='Per Pack Price can not be blank'; 
					    echo json_encode($msg); }
						else if($expiry_date==''){
						$msg['msg']='Expiry Date can not be blank'; 
					    echo json_encode($msg); }
						else if($total_quantity==''){
						$msg['msg']='Total Quantity can not be blank';
					    echo json_encode($msg); }
						else if($location==''){
						$msg['msg']='Shelf Location can not be blank';
					    echo json_encode($msg);  }
						unlink(WWW_ROOT .'files/'.$MediaNewName); die;
					 }
					 
					if(!filter_var($no_of_pack, FILTER_VALIDATE_INT)){					    
					  /* $otherError=1;
					  $ErrorColun='Unit Price'; */
					  $msg['msg']='Please Fill Correct No of pack';
				       echo json_encode($msg); unlink(WWW_ROOT .'files/'.$MediaNewName); die;
					} 
						
					if(!filter_var($total_quantity, FILTER_VALIDATE_INT)){					      
					  /* $otherError=1;
					  $ErrorColun='Qty Available'; */
					  $msg['msg']='Please Fill Correct Total Quantity';
				       echo json_encode($msg); unlink(WWW_ROOT .'files/'.$MediaNewName); die;
					} 
						
					if(!filter_var($per_pack_price, FILTER_VALIDATE_INT)){					     
					/* $otherError=1;
					$ErrorColun='Total Quantity'; */
					$msg['msg']='Please Fill Correct Per Pack Price';
				     echo json_encode($msg); unlink(WWW_ROOT .'files/'.$MediaNewName); die;
					}
					
					/* if($product_name=='' || $batch_no=='' || $no_of_pack=='' || $per_pack_price=='' || $expiry_date=='' || $total_quantity=='' || $location=='' || $otherError==1)
					 {
						$chkError=1;$chkrowError=1;
						$totalError=$totalError+1;
					    if($product_name=='')
						$ErrorColun='Product Name';
						else if($batch_no=='')
						$ErrorColun='Batch No';
						else if($no_of_pack=='')
						$ErrorColun='No Of Pack';
						else if($per_pack_price=='')
						$ErrorColun='Per Pack Price';
						else if($expiry_date=='')
						$ErrorColun='Expiry Date';
						else if($total_quantity=='')
						$ErrorColun='Total Quantity';
						else if($location=='')
						$ErrorColun='Location';
												
						$errorData[$counter]['product_name']=$product_name;
						$errorData[$counter]['batch_no']=$batch_no;
						$errorData[$counter]['no_of_pack']=$no_of_pack;
						$errorData[$counter]['per_pack_price']=$per_pack_price;
						$errorData[$counter]['total_quantity']=$total_quantity;
						$errorData[$counter]['location']=$location;
						
					} */
                    
					if($chkrowError==0)
                    {                        
                        $inventory['product_id']=$data1[0]['id'];
                        $inventory['batch_no']=$batch_no;
                        $inventory['no_of_pack']=$no_of_pack;
                        $inventory['unit_price']=$per_pack_price;
                        $inventory['expiry_date']=$expiry_date;
                        $inventory['quantity']=$total_quantity;
                        $inventory['qty_available']=$total_quantity;
                        $inventory['location']=$location;                                           
                        //pre($inventory); die;
                        $productTable = TableRegistry::get('inventory_details');
						$product = $productTable->newEntity($inventory);
						$product = $productTable->save($product);
                        //pre($products);die;
                        $row = reset($row);
						unlink(WWW_ROOT .'files/'.$MediaNewName);
                    }										
                }
				
           
			 
			 if($chkError==0)
			{
				
				$body='<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0" /><title>Arise</title><style type="text/css">
				.ExternalClass {width: 100%;}.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}body {-webkit-text-size-adjust: none;-ms-text-size-adjust: none;}body{margin: 0;padding: 0;}
				body, #body_style {width: 100% !important;min-height: inherit;color: #3c4556;background: #fff;
				font-family: Arial, Helvetica, sans-serif;font-size: 13px;line-height: 1.4;}
				table {
					border-spacing: 0;
				}
				table td {
					border-collapse: collapse;
				}
				p {
					margin: 0;
					padding: 0;
					margin-bottom: 0;
				}
				img {
					display: block;
					border: none;
					outline: none;
					text-decoration: none;
				}
				table {
					border-collapse: collapse;
					mso-table-lspace: 0pt;
					mso-table-rspace: 0pt;
				}

				/****** MEDIA QUERIES ********/
				@media only screen and (max-width: 639px) {
				body[yahoo] .hide {
					display: none !important;
				}
				body[yahoo] .mobiwide {
					width: 25px !important;
				}
				body[yahoo] .table {
					width: 320px !important;
				}
				body[yahoo] .innertable {
					width: 280px !important;
				}
				body[yahoo] .changeColor {
					color: #505E6D;
					font-size: 9px;
				}
				body[yahoo] .fontSize {
					font-size: 12px !important;
				}
				}
				</style>
				</head>

				<body style="width:100% !important; color:#3c4556; background:#fff; font-family:Arial,Helvetica,sans-serif; font-size:14px; line-height:1.4;" bgcolor="#fff" yahoo="fix">
				<div id="body_style">
				  <table cellpadding="0" cellspacing="0" border="0" align="center" style="width:100% !important; margin:0; padding:0;">
					<tr bgcolor="#fff" class="hide">
					  <td><table width="552" cellpadding="2" cellspacing="0" border="0" align="center" class="table">
						  <tr>
							<td>&nbsp;</td>
						  </tr>
						</table></td>
					</tr>
					<tr bgcolor="#fff">
					  <td>
						  <table width="552" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#fff" class="table">
						  <tr>
							<td>
								<table width="100%" cellpadding="2" cellspacing="0" border="0" bgcolor="#fff">
								<tr>
								  <td align="center"><img src="'.WWW_ROOT.'img/doctor/login_logo.png" border="0" alt="Docpharma" style="border:none; display:block; margin-left: 5px;"/></td>
								</tr>
							  </table>
							  </td>
						  </tr>
							  							  
						  <tr>
							<td><table width="100%" cellpadding="0" cellspacing="0" border="0"  bgcolor="#fff">
								<tr>
								  <td style="border-bottom: 1px solid #ddd;">&nbsp;</td>
								  <td align="left" valign="top"  style="border-bottom: 1px solid #ddd;"></td>
								  <td  style="border-bottom: 1px solid #ddd;">&nbsp;</td>
								</tr>
							  </table></td>
						  </tr>
						  <tr>
							<td><table width="100%" cellpadding="0" cellspacing="0" border="0"  bgcolor="#fff">
								<tr>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td align="center"><img src="'.WWW_ROOT.'img/success.jpg" border="0" alt="Docpharma" style="border:none; display:block; margin-left: 5px;"/></td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td style="font-size: 28px; text-align: center; font-weight: 100; color: #4c4c4c;">Data has been successfully extracted<br>from the Uploaded Document!</td>
								</tr>
							  </table></td>
						  </tr>
						 
						  <tr>
							<td><table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
								  <td style="padding:5px;"></td>
								</tr>
								<tr>
								  <td style="padding:5px;"></td>
								</tr>
								<tr>
								  <td style="padding:5px; border-top: 1px solid #ddd;"></td>
								</tr>
								<tr>
								  <td style="padding:5px;"></td>
								</tr>
								<tr>
								  <td style="color: #646262; font-size: 18px; " align="center">The uploaded document is attached to the mail for your reference.</td>
								</tr>
							  </table></td>
						  </tr>
						</table></td>
					</tr>
					  <tr bgcolor="#fff" class="hide">
					  <td><table width="552" cellpadding="2" cellspacing="0" border="0" align="center" class="table">
						  <tr>
							<td>&nbsp;</td>
						  </tr>
						</table></td>
					</tr>
				  </table>
				</div>
				</body>
				</html>
				';
		    //$mail = $this->request->getSession()->read('emailID'); 
		   //$this->Emailer->sheetUpload_mail($mail,$body);
				
			}
			/* else{
				
				$fileName = "inventory_sheet.xlsx";	
				//$objPHPExcel2 = new \PHPExcel();			
			    //pre($objPHPExcel2);die;
				//$objPHPExcel2 =  PHPExcel_IOFactory::load();
				$row=1;
				$objPHPExcel->getActiveSheet(0)
						->setCellValue('A'.$row,'Product Name')
						->setCellValue('B'.$row, 'Batch No')
						->setCellValue('C'.$row, 'Unit Price')
						->setCellValue('D'.$row, 'Qty Available')
						->setCellValue('E'.$row, 'Expiry Date')
						->setCellValue('F'.$row, 'Location')
						->setCellValue('G'.$row, 'InvalidColumn');
										
				$row2=2;
				
				foreach($errorData as $ct){ 
					
					$objPHPExcel->getActiveSheet(1)
					->setCellValue('A'.$row2, "".$ct['Product Name']."")
					->setCellValue('B'.$row2,"".$ct['Batch No']."")
					->setCellValue('C'.$row2, "".$ct['Unit Price']."")
					->setCellValue('D'.$row2, "".$ct['Qty Available']."")
					->setCellValue('E'.$row2,"".$ct['Expiry Date']."")
					->setCellValue('F'.$row2,"".$ct['Location']."")
					->setCellValue('G'.$row2, "".$ct['InvalidColumn']."");
					$row2++;
				}
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header("Content-Disposition: attachment;filename=\"$fileName\"");
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$filePath 		= WWW_ROOT .'files/';
				unlink($filePath.$fileName);
				$objWriter->save($filePath.$fileName);		
				ob_clean();
				ob_end_flush();
			}
			 */ 
            
			$msg['msg']='Data Uploaded Successfully!!';
			//$msg['totalrows']=$totalRows;
			//$msgq['tsuccess']=$totalSuccess;
			//$msgq['terror']=$totalError;
			echo json_encode($msg); die;
        }
	  }
	}
    
	public function get_id($table_name, $diff_ids, $column_name){
		  
		 $im_id= TableRegistry::get($table_name)
		        ->find()
				->select('id')
                ->where([$column_name=> $diff_ids])
				->enableHydration(false)
				->toArray();

          return $im_id; 		  
	  }
}
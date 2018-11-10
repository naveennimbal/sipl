<?php
/**
 * Created by PhpStorm.
 * User: naveen
 * Date: 13/10/18
 * Time: 10:20 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! ini_get('date.timezone') )
{
	date_default_timezone_set('Asia/Kolkata');
} 
class Main extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('users_model');
        /* ------------------ */

        $this->load->library('grocery_CRUD');

    }

    public function index($msg=1)
    {
       // echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
        //die();
        if($msg==0){$msg="invalid Username or Password ";}
        if($msg==2){$msg="Your are not logged in  ";}
        if($msg==3){$msg="Your are securely logged out   ";}
        $this->load->view('login.php',array("msg"=>$msg));
    }




    /**
     * This is for login the user and  creating the session ..
     */

    public function login(){

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $ret = $this->users_model->userLogin($username,$password);
        if($ret['isLogin']=='SUCCESS'){

            $userData = $ret['userData'][0];
            $this->session->user = $userData;

            redirect('/main/dashboard/');
            return;
        } else{
            redirect('/main/index/0');
        }

    }

    public function logout(){

        $this->session->sess_destroy();
        redirect('/main/index/3');

    }

    public function dashboard(){
        $userData = $this->session->userdata("user");
        //var_dump($userData); exit;
        if($userData->id>0){
           // echo "You are logged in "; exit;

            $this->load->view('dashboard.php',array("output"=>"Your are now logged in "));
        } else {
            redirect("main/login/2");
                return;
        }


    }





    public function employees()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('employees');
        $output = $this->grocery_crud->render();

        $this->_example_output($output);

       // echo "<pre>";
        //print_r($output);r
        
        //echo "</pre>";
        die();
    }
    
    public function vehicletax()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('vehicle_tax_master')
            ->set_subject('Vehicle Taxation')
            ->columns("vehicle_id","taxtype_id","date_from","date_to","amount_paid","amount_received","attachment")
            ->display_as('vehicle_id','Vehicle Name')
            ->display_as('taxtype_id','Tax Type')
            ->display_as('date_from','Date From')
            ->display_as('date_to','Date To')
            ->display_as('amount_paid','Amount Paid')
            ->display_as('amount_received','Amount Received')
            ->display_as('attachment','Attachment');
	
            
        $crud->fields("vehicle_id","taxtype_id","date_from","date_to","amount_paid","amount_received","attachment");
        $crud->set_rules('amount_paid','Amount Paid','required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
        $crud->required_fields("vehicle_id","taxtype_id","date_from","date_to","amount_paid","amount_received");
        
        $crud->set_relation('vehicle_id','vehicle_master','vehicle_no');
        $crud->set_relation('taxtype_id','tax_type','name');
        //$crud->set_relation('vendor_id','vehicle_master','vehicle_no');
        
        $output = $crud->render();
        $output->func = "Vehicle Tax";

        //print_r($output); exit;

        $this->load->view('layout.php',$output);
    }
        
    public function vendorbank()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('vendor_bank_master')
            ->set_subject('Vendor Bank Master')
            ->columns("vendor_id","bank_name","address","ac_name","ac_no","rtgs_ifsc")
            ->display_as('vendor_id','Vendor Name')
            ->display_as('bank_name','Bank Name')
            ->display_as('address','Bank Address')
            ->display_as('ac_name','Account Name')
            ->display_as('ac_no','Account No.')
            ->display_as('rtgs_ifsc','IFSC');
            
        $crud->fields("vendor_id","bank_name","address","ac_name","ac_no","rtgs_ifsc");
        $crud->required_fields("vendor_id","bank_name","address","ac_name","ac_no");
        
        //$crud->set_relation('vehicle_id','vehicle_master','vehicle_no');
        $crud->set_relation('vendor_id','vendor_master','name');
        
        $output = $crud->render();

       $output->func = "Vendor Bank";

        $this->load->view('layout.php',$output);
    }
    
    public function vendor()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('vendor_master')
            ->set_subject('Vendor Master')
            ->columns("name","code","address","contact_person","tin_no","gst_no")
            ->display_as('name','Vendor Name')
            ->display_as('code','Vendor Code')
            ->display_as('address','Vendor Address')
            ->display_as('contact_person','Contact Person')
            ->display_as('tin_no','TIN No.')
            ->display_as('gst_no','GST No.');
            
        $crud->fields("name","code","address","contact_person","tin_no","gst_no");
        $crud->required_fields("name","code","address","contact_person","tin_no","gst_no");
        
        //$crud->set_relation('vehicle_id','vehicle_master','vehicle_no');
        
        $output = $crud->render();

        $output->func = "Vendor";

        $this->load->view('layout.php',$output);
    }
    
    public function Naveen(){
        $crud = new grocery_CRUD();

        $crud->set_table('employees')
            ->set_subject('Employees')
            ->columns('lastName','firstName','email','jobTitle')
            ->display_as('firstName','First Name')
            ->display_as('lastName','Last Name')
            ->display_as('email','Email Address')
            ->display_as('jobTitle','Job Title');

        $crud->fields('firstName','lastName','email','jobTitle');
        $crud->required_fields('firstName','lastName');

        $output = $crud->render();

        $this->load->view('example.php',$output);

       // echo "<pre>";
       // print_r($output); exit;

        //$this->_example_output($output);
    }


    public function company(){

        $crud = new grocery_CRUD();

        $crud->set_table('company_master')
            ->set_subject('Company Details')
            ->columns("name","address","telephone","mobile","contact_person","contact_mobile","gst_no","logo")
            ->display_as('name','Name')
            ->display_as('address','Address')
            ->display_as('telephone','Telephone')
            ->display_as('mobile','Mobile')
            ->display_as('gst_no','GST No.')
            ->display_as('logo','Logo')
            ->display_as('contact_person','Contact Person')
            ->display_as('contact_mobile','Contact Mobile');

        $crud->fields('name','address','telephone','mobile','contact_person','contact_mobile','gst_no','logo');
        //$crud->required_fields('firstName','lastName');
        $crud->required_fields('name','address','mobile','gst_no');
        $output = $crud->render();

        $output->func = "Company";

        $this->load->view('layout.php',$output);
    }

    public function policies()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('vehicle_policy_master')
            ->set_subject('Vehicle Policy')
            ->columns("companyname","vehicle_id","date_from","date_to","amount","assigned_to","policy_copy")
            ->display_as('companyname','Policy Company Name')
            ->display_as('vehicle_id','Vehicle No.')
            ->display_as('date_from','Vaid From')
            ->display_as('date_to','Valid To')
            ->display_as('amount','amount')
            ->display_as('assigned_to','Vehicle Assigned To')
           // ->display_as('sold','Is Sold')
            ->display_as('policy_copy','Policy Copy');
            
            
           

        $crud->fields("companyname","vehicle_id","date_from","date_to","amount","assigned_to","policy_copy");
        $crud->required_fields("companyname","vehicle_id","date_from","date_to","amount","policy_copy");
        
        $crud->set_relation('vehicle_id','vehicle_master','vehicle_no');
        
        $output = $crud->render();

        $output->func = "Policy";

        $this->load->view('layout.php',$output);
    }

    public function vehiclemake()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('vehicle_make_master')
            ->set_subject('Vehicle Make')
            ->columns("make")
            ->display_as('make','Vehicle Make');

        $crud->fields('make');
        $crud->required_fields('make');
        
        

        $output = $crud->render();

        $output->func = "Vehicle Make";
       // print_r($output); exit;

        $this->load->view('layout.php',$output);

    }    
    
        
    public function vehiclemaster()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('vehicle_master')
            ->set_subject('Vehicle Details')
            ->columns("vehicle_no","description","reg_authority","make","model","chasis_no","engine_no","purchase_date","sold","sold_to","address","mobile","sale_date","rc_copy")
            ->display_as('vehicle_no','Vehicle No.')
            ->display_as('description','Description')
            ->display_as('reg_authority','Regulatory Authority')
            ->display_as('make','Make')
            ->display_as('model','Model')
            ->display_as('chasis_no','Chasis No')
            ->display_as('engine_no','Engine No.')
            ->display_as('purchase_date','Purchase Date')
            ->display_as('sold','Is Sold(Y/N)?')
            ->display_as('sold_to','Sold To')            
            ->display_as('address','Address')
            ->display_as('mobile','Mobile')
            ->display_as('sale_date','Date Of Sale')
            ->display_as('rc_copy','RC Copy');

        $crud->set_field_upload('rc_copy','assets/uploads/files');
            

        $crud->fields("vehicle_no","description","reg_authority","make","model","chasis_no","engine_no","purchase_date","sold","sold_to","address","mobile","sale_date","rc_copy");
        //$crud->required_fields('firstName','lastName');
        
        $crud->required_fields("vehicle_no","description","reg_authority","make","model","chasis_no","engine_no","purchase_date","rc_copy");
        
        $crud->callback_add_field('sold',array($this,'add_checkbox')); 
        $crud->callback_edit_field('sold',array($this,'edit_checkbox'));
        
        $output = $crud->render();

        $output->func = "Vehicle";

        $this->load->view('layout.php',$output);
    }
    
    public function role(){

        $crud = new grocery_CRUD();

        $crud->set_table('role_master')
            ->set_subject('Roles')
            ->columns("role")
            ->display_as('role','Role Name');

        $crud->fields('role');
        $crud->required_fields('role');

        $output = $crud->render();

        $output->func = "Roles";

        $this->load->view('layout.php',$output);

    }

    public function state(){

        $crud = new grocery_CRUD();

        $crud->set_table('state_master')
            ->set_subject('State')
            ->columns("state")
            ->display_as('state','State');

        $crud->fields('state');
        $crud->required_fields('state');

        $output = $crud->render();

		$output->func = "States";

        $this->load->view('layout.php',$output);

    }


    public function uom(){

        $crud = new grocery_CRUD();

        $crud->set_table('uom_master')
            ->set_subject('UOM')
            ->columns("uom")
            ->display_as('uom','Unit Of Measurement');

        $crud->fields('uom');
        $crud->required_fields('uom');

        $output = $crud->render();

        $output->func = "UOM";

        $this->load->view('layout.php',$output);

    }
    
    public function material()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('material_master')
            ->set_subject('Material/Item Details')
            ->columns("item")
            ->display_as('item','Item Name');

        $crud->fields('item');
        $crud->required_fields('item');

        $output = $crud->render();

        $output->func = "Material";

        $this->load->view('layout.php',$output);

    }    


    
    public function user(){

        $crud = new grocery_CRUD();

        $crud->set_table('user_master')
            ->set_subject('User')
            ->columns("name","address","mobile","landline","user_name","password","role_id","is_add","is_change","is_delete","is_print","is_email","admin_panel","active")
            ->display_as('name','Name')
            ->display_as('Address','Address')
            ->display_as('mobile','Mobile No.')
            ->display_as('landline','Landline No.')
            ->display_as('user_name','Username.')
            ->display_as('password','Password')
            ->display_as('role_id','Role')
            ->display_as('is_add','Add(Y/N)?')
            ->display_as('is_change','Change(Y/N)?')
            ->display_as('is_delete','Delete(Y/N)?')
            ->display_as('is_print','Print(Y/N)?')
            ->display_as('is_email','Email(Y/N)?')
            ->display_as('admin_panel','Admin Panel(Y/N)?')
            ->display_as('active','Is Active(Y/N)?');

        $crud->fields("name","address","mobile","landline","user_name","password","role_id","is_add","is_change","is_delete","is_print","is_email","admin_panel","is_active");
        $crud->required_fields("name","address","mobile","user_name","password");

        $output = $crud->render();

        $output->func = "Users";

        $this->load->view('layout.php',$output);

    }
    
    function add_checkbox()
{
return '<input type="checkbox"  value="Y" name="sold" >';
}

function edit_checkbox($value, $primary_key)
{
    $checked = "";
    $val = "N";
    if($value=="Y"){
        $checked = "checked";
    }
return '<input type="checkbox" '.$checked.'  value="'.$val.'" name="sold" >';
}


}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */
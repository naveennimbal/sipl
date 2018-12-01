<?php
/**
 * Created by PhpStorm.
 * User: naveen
 * Date: 13/10/18
 * Time: 10:20 AM
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!ini_get('date.timezone')) {
    date_default_timezone_set('Asia/Kolkata');
}

class Main extends CI_Controller
{

    function __construct()
    {
        parent::__construct();




        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('users_model');
        $this->load->model('permissions_model');
        $this->load->model('material_model');
        /* ------------------ */
        $this->load->library('form_validation');

        $this->load->library('grocery_CRUD');
        $this->checkLogin();

    }

    public function dashboard()
    {
        $userData = $this->session->userdata("user");
        //var_dump($userData); exit;
        if (isset($userData->id) && $userData->id > 0) {
            // echo "You are logged in "; exit;

            $tables = array();
            $tables['Company'] = "company_master";
            $tables['Vehicle'] = "vehicle_master";
            $tables['Vehicle Policy'] = "vehicle_policy_master";
            $tables['Vehicle Taxation'] = "vehicle_tax_master";
            $tables['Vendor'] = "vendor_master";
            $tables['Vendor Bank'] = "vendor_bank_master";
            $tables['Vendor GST'] = "vendor_gst";
            $tables['Project Activity'] = "activity_description_master";
            $tables['Project'] = "project_master";            
            $tables['Project Scope'] = "project_scope";
            $tables['Property'] = "property_master";           
            $tables['Personal Expense'] = "personal_expense_master";



            $res = $this->permissions_model->getDashboard();

            $dashboard = $this->load->view('userdash.php',array("output"=>$res),TRUE);
            $this->load->view('dashboard.php', array("output" => $dashboard));
        } else {
            redirect("login/index/2");
            return;
        }


    }

    public function policy_provider()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('policy_provider')
            ->set_subject('Policy Provider Details')
            ->columns("name","description")
            ->display_as('name','Policy Company Name')
            ->display_as('description','Description');          
            
        $crud->fields("name","description");
        $crud->required_fields("name","description");        
        
        //$crud->set_relation('name','policy_','name');    
        
        $output = $crud->render();

        $output->func = "Policy Provider Master";

        $this->load->view('layout.php',$output);
    }
    
    public function employee()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('employee_master')
            ->set_subject('Employee Details')
            ->columns("name","address","mobile","blood_group")
            ->display_as('name','Employee Name')
            ->display_as('address','Address')
            ->display_as('mobile','Mobile')
            ->display_as('blood_group','Blood Group');
          
            
        $crud->fields("name","address","mobile","blood_group");
        $crud->required_fields("name","address","mobile");        
        $output = $crud->render();

        $output->func = "Employee Master";

        $this->load->view('layout.php',$output);
    }
    
    public function property_rent()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('property_transaction')
            ->set_subject('Property Rent')
            ->columns("property_id","vendor_id","bill_no","invoice_date","description","total_period","amount")
            
            ->display_as('property_id','Property Name')
            ->display_as('vendor_id','Tennant Name')
            ->display_as('bill_no','Bill No.')
            ->display_as('invoice_date','Invoice Date')
            ->display_as('description','Particulars')
            ->display_as('total_period','Month')
            ->display_as('amount','Amount');            
	
            
        $crud->fields("property_id","vendor_id","bill_no","invoice_date","description","total_period","amount");
               
        $crud->required_fields("property_id","vednor_id","description","invoice_date","bill_no","total_period","amount");

        $crud->set_relation('vendor_id','vendor_master','name');    
        $crud->set_relation('property_id','property_master','name');    

        
        $output = $crud->render();
        $output->func = "Property Rent Details";

        $this->load->view('layout.php',$output);
    }
    
    public function property_electricity()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('property_transaction')
            ->set_subject('Electricity Rent Invoice')
            ->columns("property_id","vendor_id","bill_no","invoice_date","description","total_period","amount")
            
            ->display_as('property_id','Property Name')
            ->display_as('vendor_id','Tennant Name')
            ->display_as('bill_no','Bill No.')
            ->display_as('invoice_date','Invoice Date')
            ->display_as('description','Particulars')
            ->display_as('total_period','Month')
            ->display_as('amount','Amount');            
	
            
        $crud->fields("property_id","vendor_id","bill_no","invoice_date","description","total_period","amount");
               
        $crud->required_fields("property_id","vendor_id","description","invoice_date","bill_no","total_period","amount");
        
        $crud->set_relation('vendor_id','vendor_master','name');    
        $crud->set_relation('property_id','property_master','name');    
        
        $output = $crud->render();
        $output->func = "Electricity Rent Details";

        $this->load->view('layout.php',$output);
    }
    
    private function checkPermission($tableName){
        $userData = $this->session->userdata("user");
        $res = $this->permissions_model->checkPermission($userData->id,$tableName);
        $permission = $res[0];

        //var_dump($permission); exit;
       // $result = array();
       // if($permission['is_list']=="Yes")
        return $permission;

    }

    private function addDelPermission($per,$crud){
        if($per->is_list=="No" && $per->is_list='Yes'){
            redirect('main/dashboard/0');
        }

        if($per->is_add=="No" && $per->is_add!='Yes'){
            $crud->unset_add();
        }
        if($per->is_edit=="No" && $per->is_edit!='Yes'){
            $crud->unset_edit();
        }
        if($per->is_delete=="No" && $per->is_delete!='Yes'){
            $crud->unset_delete();
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


    public function quotations()
    {
    	    $crud = new grocery_CRUD();
        	$crud->set_table("requirement_master")
            ->set_subject('Quotation/Item Requirement')
            ->columns("project_id","quotation_type","proj_date","part_no","quantity","amount","status","attachment")
            
            ->display_as('project_id','Project Name')
            ->display_as('quotation_type','Type')
            ->display_as('proj_date','Date')
            ->display_as('part_no','Material Name')
            ->display_as('quantity','Quantity')
            ->display_as('amount','Amount')
            ->display_as('status','Status')
            ->display_as('attachment','Attachment');            
	
        $crud->fields("project_id","quotation_type","proj_date","part_no","quantity","amount","status","attachment");
        $crud->required_fields("project_id","quotation_type","proj_date","part_no","quantity","amount","status");

		$crud->set_relation('project_id','project_master','name');                
		
		$crud->set_relation('quotation_type','quotation_type','name');
		
		$crud->set_relation('part_no','material_master','item');
		
		$crud->set_field_upload('attachment','assets/uploads/files');
		        
        $output = $crud->render();
        $output->func = "Quotation/Item Requirement Master";

        $this->load->view('layout.php',$output);
    }
    
public function vendorgst()
{
        $crud = new grocery_CRUD();

        $crud->set_table('vendor_gst')
            ->set_subject('Vendor State GST Details')
            ->columns("vendor_id","state_id","address","gst")
            
            ->display_as('vendor_id','Vendor Name')
            ->display_as('state_id','State')
            ->display_as('address','Address')
            ->display_as('gst','GST No.');            
	
        $crud->fields("vendor_id","state_id","address","gst");
        $crud->required_fields("vendor_id","state_id","address","gst");           
        
        $crud->set_relation('vendor_id','vendor_master','name');    
        $crud->set_relation('state_id','state_master','state');    

                
        $output = $crud->render();
        $output->func = "Vendor State GST Master";

        $this->load->view('layout.php',$output);	
	
}

public function purchaseorder()
{
        $crud = new grocery_CRUD();

        $crud->set_table('purchase_order_master')
            ->set_subject('Purchase Order Details')
            ->columns("company_id","vendor_id","vendor_bank_id","po_no","po_date","vendor_ref_no","site_address")
            
            ->display_as('company_id','Company Name')
            ->display_as('vendor_id','Vendor Name')
            ->display_as('vendor_bank_id','Vendor Bank')
            ->display_as('po_no','PO. No.')
            ->display_as('po_date','PO. Date')
            ->display_as('vendor_ref_no','Vendor Ref. No.')
            ->display_as('site_address','Site Address');            
	
        $crud->fields("company_id","vendor_id","vendor_bank_id","po_no","po_date","vendor_ref_no","site_address");
        $crud->required_fields("company_id","vendor_id","vendor_bank_id","po_no","po_date","vendor_ref_no","site_address");           
        
        $crud->set_relation('vendor_id','vendor_master','name');    
        $crud->set_relation('vendor_bank_id','vendor_bank_master','bank_name');    

                
        $output = $crud->render();
        $output->func = "Purchase Order Master";

        $this->load->view('layout.php',$output);		
}
    
public function machinedpr()
    {
        $crud = new grocery_CRUD();
    	
	}    
	
public function projectdpr()
    {
        $crud = new grocery_CRUD();
    	
	}    
	
public function projectactivity()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('activity_description_master')
            ->set_subject('Project Activity Description Details')
            ->columns("description")
            
            ->display_as('description','Activity Description');            
	
        $crud->fields("description");               
        $crud->required_fields("description");
                
        $output = $crud->render();
        $output->func = "Project Activity Description Master";

        $this->load->view('layout.php',$output);
    }
    	
public function projectscope()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('project_scope')
            ->set_subject('Project Scope Details')
            ->columns("project_id","description_id","soq_no","area","uom_id","soq")
            
            ->display_as('project_id','Project Name')
            ->display_as('soq_no','SOQ No')
            ->display_as('description_id','Activity Description')
            ->display_as('area','Area')
            ->display_as('uom_id','UOM')
            ->display_as('soq','SOQ');            
	
        $crud->fields("project_id","description_id","soq_no","area","uom_id","soq");               
        $crud->required_fields("project_id","description_id","soq_no","area","uom_id","soq");
        
        $crud->set_relation('project_id','project_master','name');
        $crud->set_relation('uom_id','uom_master','uom');
        $crud->set_relation('description_id','activity_description_master','description');

                
        $output = $crud->render();
        $output->func = "Project Scope Master";

        $this->load->view('layout.php',$output);
    }
    
    public function project()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('project_master')
            ->set_subject('Project Details')
            ->columns("name","address","stateid","nature_of_work","employee_id","po_no")
            
            ->display_as('name','Project Name')
            ->display_as('address','Site Address')
            ->display_as('stateid','State')
            ->display_as('nature_of_work','Nature Of Work')
            ->display_as('employee_id','Project Incharge')
            ->display_as('po_no','PO. No.');            
	
        $crud->fields("name","address","stateid","nature_of_work","employee_id","po_no");               
        $crud->required_fields("name","address","stateid","nature_of_work","employee_id","po_no");
        
       return $crud->set_relation('employee_id','employee_master','name');
        $crud->set_relation('stateid','state_master','state');
                
        $output = $crud->render();
        $output->func = "Project Master";

        $this->load->view('layout.php',$output);
    }
        
       
    public function vehiclemovement()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('vehicle_movement_master')
            ->set_subject('Vehicle Movement')
            ->columns("vehicle_id","from_location","to_location","start_date")
            
            ->display_as('vehicle_id','Vehicle No.')
            ->display_as('from_location','Location From')
            ->display_as('to_location','Location To')
            ->display_as('start_date','Start Date');            
	
        $crud->fields("vehicle_id","from_location","to_location","start_date");               
        $crud->required_fields("vehicle_id","from_location","to_location","start_date");
        $crud->set_relation('vehicle_id','vehicle_master','vehicle_no');

                
        $output = $crud->render();
        $output->func = "Vehicle Movement Master";

        $this->load->view('layout.php',$output);
    }
        
    public function personalexpense()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('personal_expense_master')
            ->set_subject('Personal Expense Details')
            ->columns("employee_id","phoneno","biling_cycle_from","biling_cycle_to","reminder")
            
            ->display_as('employee_id','Employee Name')
            ->display_as('phoneno','Mobile')
            ->display_as('biling_cycle_from','Billing Cycle From')
            ->display_as('biling_cycle_to','Billing Cycle To')
            ->display_as('reminder','Reminder');            
	
        $crud->fields("employee_id","phoneno","biling_cycle_from","biling_cycle_to","reminder");               
        $crud->required_fields("employee_id","phoneno","biling_cycle_from","biling_cycle_to","reminder");
        
        $crud->set_relation('employee_id','employee_master','name');    
        
        //$crud->callback_add_field('reminder',array($this,'add_checkbox_expense'));
        //$crud->callback_edit_field('reminder',array($this,'edit_checkbox_expense'));
                
        $output = $crud->render();
        $output->func = "Pers. Expense Master";

        $this->load->view('layout.php',$output);
    }
        
    public function property()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('property_master')
            ->set_subject('Properties Details')
            ->columns("name","address","elec_biling_cycle_from","elec_biling_cycle_to","water_biling_cycle_from","water_biling_cycle_to","htax_biling_cycle_from","htax_biling_cycle_to","reminder","rented","lease_from","lease_to","lease_escalation","percent_increment","hsn_code","amount")
            
            ->display_as('name','Property Name')
            ->display_as('address','Property Address')
            ->display_as('elec_biling_cycle_from','Elect. Billing Cycle From')
            ->display_as('elec_biling_cycle_to','Elect. Billing Cycle To')
            ->display_as('water_biling_cycle_from','Water Billing Cycle From')
            ->display_as('water_biling_cycle_to','Water Billing Cycle To')
            ->display_as('htax_biling_cycle_from','H. Tax Billing Cycle From')
            ->display_as('htax_biling_cycle_to','H. Tax Billing Cycle To')           
            ->display_as('reminder','Reminder')
            ->display_as('rented','Rented')
            ->display_as('lease_from','Lease Valid From')
            ->display_as('lease_to','Lease Valid To')
            ->display_as('lease_escalation','Lease Escalation')
            ->display_as('percent_increment','Rent Increment(%)')
            ->display_as('hsn_code','HSN/SAC Code')
            ->display_as('amount','Amount');            
	
            
        $crud->fields("name","address","elec_biling_cycle_from","elec_biling_cycle_to","water_biling_cycle_from","water_biling_cycle_to","htax_biling_cycle_from","htax_biling_cycle_to","reminder","rented","lease_from","lease_to","lease_escalation","percent_increment","hsn_code","amount");
               
        $crud->required_fields("name","address","elec_biling_cycle_from","elec_biling_cycle_to","water_biling_cycle_from","water_biling_cycle_to","htax_biling_cycle_from","htax_biling_cycle_to","reminder","rented");
        
		$crud->set_rules('amount','Amount','callback_validate_money');
		$crud->set_rules('percent_increment','Rent Increment(%)','required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');


        $output = $crud->render();
        $output->func = "Property Master";

        $this->load->view('layout.php',$output);
    }
 
public function validate_money ($input) 
{
    if(preg_match('/^[0-9]*\.?[0-9]+$/', $input)){
        return true;
    } 
    else 
    {
        $this->form_validation->set_message('validate_money','Please enter a valid Amount!');
        return false;
    }
}
    public function vehicletax()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('vehicle_tax_master')
            ->set_subject('Vehicle Taxes')
            ->columns("vehicle_id","taxtype_id","date_from","date_to","amount_paid","amount_received","reminder","attachment")
            ->display_as('vehicle_id','Vehicle Name')
            ->display_as('taxtype_id','Tax Type')
            ->display_as('date_from','Date From')
            ->display_as('date_to','Date To')
            ->display_as('amount_paid','Amount Paid')
            ->display_as('amount_received','Receipt Received')
            ->display_as('reminder','Reminder')
            ->display_as('attachment','Tax Receipt');
	
            
        $crud->fields("vehicle_id","taxtype_id","date_from","date_to","amount_paid","amount_received","reminder","attachment");
        $crud->set_rules('amount_paid','Amount Paid','required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
        $crud->required_fields("vehicle_id","taxtype_id","date_from","date_to","amount_paid","reminder","amount_received","attachment");
        
        $crud->set_relation('vehicle_id','vehicle_master','vehicle_no');
        $crud->set_relation('taxtype_id','tax_type','name');
        //$crud->set_relation('vendor_id','vehicle_master','vehicle_no');
        $crud->set_field_upload('attachment','assets/uploads/files');
        
        $output = $crud->render();
        $output->func = "Vehicle Tax";

        $this->load->view('layout.php',$output);
    }
        
    public function vendorbank()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('vendor_bank_master')
            ->set_subject('Vendor Bank Details')
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

        $materialArray = array();

        $materials = $this->material_model->getMaterials();

        foreach ($materials as $material){
            $materialArray[$material->id] = $material->item;
        }



        $crud = new grocery_CRUD();

        $crud->set_table('vendor_master')
            ->set_subject('Vendor Details')
            ->columns("name","code","address","material_id","place_of_supply","invoice_submission","contact_person","tin_no","gst_no")
            ->display_as('name','Name')
            ->display_as('code','Code')
            ->display_as('address','Address')
            ->display_as('material_id','Material Name')
            ->display_as('place_of_supply','Place Of Supply')
            ->display_as('invoice_submission','Invoice Submission')
            ->display_as('contact_person','Contact Person')
            ->display_as('tin_no','TIN No.')
            ->display_as('gst_no','GST No.');
            
        $crud->fields("name","code","address","material_id","place_of_supply","invoice_submission","contact_person","tin_no","gst_no");
        $crud->required_fields("name","code","address","place_of_supply","invoice_submission","contact_person","tin_no","gst_no");

        $crud->field_type('material_id','multiselect',$materialArray);
        
        //$crud->set_relation('material_id','material_master','item');
        
        $output = $crud->render();

        $output->func = "Vendor Master";

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
        //print_r($output); exit;

        //$this->_example_output($output);
    }


    public function company(){

        $crud = new Crud();

        $crud->set_table('company_master')
            ->set_subject('Company Details')
            ->columns("name","address","state_id","telephone","contact_person","contact_mobile","gst_no","pan_no","logo")
            ->display_as('name','Name')
            ->display_as('address','Address')
            ->display_as('state_id','State')
            ->display_as('telephone','Telephone')
            ->display_as('gst_no','GST No.')
             ->display_as('pan_no','PAN No.')
            ->display_as('logo','Logo')
            ->display_as('contact_person','Contact Person')
            ->display_as('contact_mobile','Contact Mobile');

        $crud->fields('name','address','state_id','telephone','contact_person','contact_mobile','gst_no',"pan_no",'logo');
        $crud->set_field_upload('logo','assets/uploads/files');
        
        $crud->set_relation('state_id','state_master','state');
        
        //$crud->required_fields('firstName','lastName');
        $crud->required_fields('name','address','state_id','mobile','gst_no','pan_no');
        $output = $crud->render();

        $output->func = "Company Master";

        $this->load->view('layout.php',$output);
    }

    public function policies()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('vehicle_policy_master')
            ->set_subject('Vehicle Policy')
            ->columns("companyname","vehicle_id","date_from","date_to","amount","employee_id","policy_copy")
            ->display_as('companyname','Policy Company Name')
            ->display_as('vehicle_id','Vehicle No.')
            ->display_as('date_from','Vaid From')
            ->display_as('date_to','Valid To')
            ->display_as('amount','amount')
            ->display_as('employee_id','Employee Name')
           // ->display_as('sold','Is Sold')
            ->display_as('policy_copy','Policy Copy');
            
            
        $crud->set_field_upload('policy_copy','assets/uploads/files');  

        $crud->fields("companyname","vehicle_id","date_from","date_to","amount","employee_id","policy_copy");
        $crud->required_fields("companyname","vehicle_id","date_from","date_to","amount","policy_copy");
        $crud->set_relation('employee_id','employee_master','name');
        
        $crud->set_relation('vehicle_id','vehicle_master','vehicle_no');
        $crud->set_relation('companyname','policy_provider','name');
        
        
        $output = $crud->render();

        $output->func = "Vehicle Policy Master";

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

        $this->load->view('layout.php',$output);

    }    
    
        
    public function vehiclemaster()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('vehicle_master')
            ->set_subject('Vehicle Details')
            ->columns("vehicle_no","description","reg_authority","make","model","chasis_no","engine_no","permit_type","purchase_date","project_id","rc_copy","sold")
            ->display_as('vehicle_no','Vehicle No.')
            ->display_as('description','Description')
            ->display_as('reg_authority','Regulatory Authority')
            ->display_as('make','Make')
            ->display_as('model','Model')
            ->display_as('chasis_no','Chasis No')
            ->display_as('engine_no','Engine No.')
            ->display_as('permit_type','Permit Type')            
            ->display_as('purchase_date','Purchase Date')
            ->display_as('project_id','Project Assigned')
            ->display_as('sold','Sold(Y/N)')
            ->display_as('rc_copy','RC Copy');
            
           $crud->set_field_upload('rc_copy','assets/uploads/files');

        $crud->fields("vehicle_no","description","reg_authority","make","model","chasis_no","engine_no","permit_type","purchase_date","project_id","sold","sold_to","address","mobile","sale_date","rc_copy");
        //$crud->required_fields('firstName','lastName');
        $crud->set_relation('permit_type','permit_master','permit');
        
        $crud->set_relation('project_id','project_master','name');
        
        $crud->required_fields("vehicle_no","description","reg_authority","make","model","chasis_no","engine_no","purchase_date","project_id","rc_copy");
        
       // $crud->callback_add_field('sold',array($this,'add_checkbox'));
        //$crud->callback_edit_field('sold',array($this,'edit_checkbox'));
        
        $output = $crud->render();

        $output->func = "Vehicle Master";

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

        $output->func = "Application Role Master";

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

		$output->func = "State Master";

        $this->load->view('layout.php',$output);

    }


    public function uom(){

        $crud = new grocery_CRUD();

        $crud->set_table('uom_master')
            ->set_subject('Measurement Units')
            ->columns("uom")
            ->display_as('uom','Unit Of Measurement');

        $crud->fields('uom');
        $crud->required_fields('uom');

        $output = $crud->render();

        $output->func = "Measurement Units";

        $this->load->view('layout.php',$output);

    }
    
    public function material()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('material_master')
            ->set_subject('Material/Item Details')
            ->columns("item","part_no")
            ->display_as('item','Item Name')
            ->display_as('part_no','Part No.');

        $crud->fields('item');
        $crud->required_fields('item');

        $output = $crud->render();

        $output->func = "Material Master";

        $this->load->view('layout.php',$output);

    }    


    
    public function user(){

        $crud = new grocery_CRUD();

        $crud->set_table('user_master')
            ->set_subject('User Details')
            ->columns("name","address","mobile","user_name","password","role_id","is_add","is_change","is_delete","is_print","admin_panel","active")
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
            ->display_as('admin_panel','Admin Panel(Y/N)?')
            ->display_as('active','Active(Y/N)?');

        $crud->fields("name","address","mobile","landline","user_name","password","role_id","is_add","is_change","is_delete","is_print","admin_panel","active");
        $crud->required_fields("name","address","mobile","role_id","user_name","password");
        $crud->set_relation('role_id','role_master','role');
        
       /* $crud->callback_add_field('is_add',array($this,'add_checkbox_add'));
       // $crud->callback_edit_field('is_add',array($this,'edit_checkbox_add'));
                
        $crud->callback_add_field('is_change',array($this,'add_checkbox_edit')); 
        $crud->callback_edit_field('is_change',array($this,'edit_checkbox_edit'));
        
		$crud->callback_add_field('is_delete',array($this,'add_checkbox_del')); 
        $crud->callback_edit_field('is_delete',array($this,'edit_checkbox_del'));
        
        $crud->callback_add_field('is_print',array($this,'add_checkbox_print')); 
        $crud->callback_edit_field('is_print',array($this,'edit_checkbox_print'));        
        
        $crud->callback_add_field('admin_panel',array($this,'add_checkbox_admin')); 
        $crud->callback_edit_field('admin_panel',array($this,'edit_checkbox_admin'));                
        
        $crud->callback_add_field('active',array($this,'add_checkbox_active')); 
        $crud->callback_edit_field('active',array($this,'edit_checkbox_active'));

       */

        $crud->add_action('Permissions', '', '','fa fa-user',array($this,'add_permission_link'));
                
        $output = $crud->render();

        $output->func = "User Master";

        $this->load->view('layout.php',$output);

    }


    function add_permission_link($primary_key )
    {
        return site_url('permissions/userpermission/'.$primary_key);
    }



    function add_checkbox_expense()
    {
        return '<input type="checkbox"  value="Y" name="reminder" >';
    }

    function edit_checkbox_expense($value, $primary_key)
    {
        $checked = "";
        $val = "N";
        if ($value == "Y") {
            $checked = "checked";
        }
        return '<input type="checkbox" ' . $checked . '  value="' . $val . '" name="reminder" >';
    }

    function add_checkbox_reminder()
    {
        return '<input type="checkbox"  value="Y" name="reminder" >';
    }

    function edit_checkbox_reminder($value, $primary_key)
    {
        $checked = "";
        $val = "N";
        if ($value == "Y") {
            $checked = "checked";
        }
        return '<input type="checkbox" ' . $checked . '  value="' . $val . '" name="reminder" >';
    }

    function add_checkbox_rented()
    {
        return '<input type="checkbox"  value="Y" name="rented" >';
    }

    function edit_checkbox_rented($value, $primary_key)
    {
        $checked = "";
        $val = "N";
        if ($value == "Y") {
            $checked = "checked";
        }
        return '<input type="checkbox" ' . $checked . '  value="' . $val . '" name="rented" >';
    }

    function add_checkbox()
    {
        return '<input type="checkbox"  value="Y" name="sold" >';
    }

    function edit_checkbox($value, $primary_key)
    {
        $checked = "";
        $val = "N";
        if ($value == "Y") {
            $checked = "checked";
        }
        return '<input type="checkbox" ' . $checked . '  value="' . $val . '" name="sold" >';
    }

    function add_checkbox_add()
    {
        return '<input type="checkbox"  value="Y" name="is_add" >';
    }

    function edit_checkbox_add($value, $primary_key)
    {
        $checked = "";
        $val = "N";
        if ($value == "Y") {
            $checked = "checked";
        }
        return '<input type="checkbox" ' . $checked . '  value="' . $val . '" name="is_add" >';
    }

    function add_checkbox_edit()
    {
        return '<input type="checkbox"  value="Y" name="is_change" >';
    }

    function edit_checkbox_edit($value, $primary_key)
    {
        $checked = "";
        $val = "N";
        if ($value == "Y") {
            $checked = "checked";
            $val = "Y";
        }
        return '<input type="checkbox" ' . $checked . '  value="' . $val . '" name="is_change" >';
    }

    function add_checkbox_del()
    {
        return '<input type="checkbox"  value="Y" name="is_delete" >';
    }

    function edit_checkbox_del($value, $primary_key)
    {
        $checked = "";
        $val = "N";
        if ($value == "Y") {
            $checked = "checked";
        }
        return '<input type="checkbox" ' . $checked . '  value="' . $val . '" name="is_delete" >';
    }

    function add_checkbox_print()
    {
        return '<input type="checkbox"  value="Y" name="is_print" >';
    }

    function edit_checkbox_print($value, $primary_key)
    {
        $checked = "";
        $val = "N";
        if ($value == "Y") {
            $checked = "checked";
        }
        return '<input type="checkbox" ' . $checked . '  value="' . $val . '" name="is_print" >';
    }

    function add_checkbox_active()
    {
        return '<input type="checkbox"  value="Y" name="active" >';
    }

    function edit_checkbox_active($value, $primary_key)
    {
        $checked = "";
        $val = "N";
        if ($value == "Y") {
            $checked = "checked";
        }
        return '<input type="checkbox" ' . $checked . '  value="' . $val . '" name="active" >';
    }

    function add_checkbox_admin()
    {
        return '<input type="checkbox"  value="Y" name="admin_panel" >';
    }

    function edit_checkbox_admin($value, $primary_key)
    {
        $checked = "";
        $val = "N";
        if ($value == "Y") {
            $checked = "checked";
        }
        return '<input type="checkbox" ' . $checked . '  value="' . $val . '" name="admin_panel" >';
    }

    private function checkLogin()
    {

        $user = $this->session->userdata('user');
        if (!isset($user->id)) {
            redirect("login/index/2");
        }

    }


}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */
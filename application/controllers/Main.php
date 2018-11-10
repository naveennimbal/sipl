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
        /* ------------------ */

        $this->load->library('grocery_CRUD');


    }

    public function dashboard()
    {
        $userData = $this->session->userdata("user");
        //var_dump($userData); exit;
        if (isset($userData->id) && $userData->id > 0) {
            // echo "You are logged in "; exit;

            $tables = array();
            $tables['Company'] = "company_master";
            $tables['Material'] = "material_master";
            $tables['UOM'] = "uom_master";
            $tables['Vehicle'] = "vehicle_master";
            $tables['Vehicle Policy'] = "vehicle_policy_master";
            // $tables['Vehicle Policy'] = "vehicle_policy_master";
            $tables['Vehicle Taxation'] = "vehicle_tax_master";
            $tables['Vendor'] = "vendor_master";
            $tables['Vendor Bank'] = "vendor_bank_master";
            $tables['Property'] = "property_master";
            $tables['Project'] = "project_master";
            $tables['Personal Expense'] = "personal_expense_master";



            $res = $this->permissions_model->getDashboard();

            $dashboard = $this->load->view('userdash.php',array("output"=>$res),TRUE);
            $this->load->view('dashboard.php', array("output" => $dashboard));
        } else {
            redirect("login/index/2");
            return;
        }


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
		
    public function project()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('project_master')
            ->set_subject('Project Details')
            ->columns("name","address","stateid","proj_incharge","mobile","area","uomid","soq")
            
            ->display_as('name','Project Name')
            ->display_as('address','Site Address')
            ->display_as('stateid','Site Location')
            ->display_as('proj_incharge','Project Incharge')
            ->display_as('mobile','Mobile No.')
            ->display_as('area','Site Area')
            ->display_as('uomid','Measurement Unit')
            ->display_as('soq','SOQ');            
	
        $crud->fields("name","address","stateid","proj_incharge","mobile","area","uomid","soq");               
        $crud->required_fields("name","address","stateid","proj_incharge","mobile","area","uomid","soq");
        
        $crud->set_relation('uomid','uom_master','uom');
        $crud->set_relation('stateid','state_master','state');
        
        //$crud->callback_add_field('reminder',array($this,'add_checkbox_expense')); 
        //$crud->callback_edit_field('reminder',array($this,'edit_checkbox_expense'));                
                
        $output = $crud->render();
        $output->func = "Project Master";

        $this->load->view('layout.php',$output);
    }
        
    public function Quotations()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('quotation_master')
            ->set_subject('Quotation Item/Requirements')
            ->columns("project_id","type","to_location","project_date","description","remarks","attachment")
            
            ->display_as('project_id','Project Name')
            ->display_as('type','Type')
            ->display_as('project_date','Date')
            ->display_as('description','Description')
            ->display_as('remarks','Remarks')
            ->display_as('attachment','Attachment');            
	
        $crud->fields("project_id","type","to_location","project_date","description","remarks","attachment");               
        $crud->required_fields("project_id","type","to_location","project_date");
        
        $crud->set_relation('project_id','project_master','name');
        $crud->set_relation('type','quotation_type','name');
        
        //$crud->callback_add_field('reminder',array($this,'add_checkbox_expense')); 
        //$crud->callback_edit_field('reminder',array($this,'edit_checkbox_expense'));                
                
        $output = $crud->render();
        $output->func = "Quotation Item/Requirement Details";

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
        //$crud->callback_add_field('reminder',array($this,'add_checkbox_expense')); 
        //$crud->callback_edit_field('reminder',array($this,'edit_checkbox_expense'));                
                
        $output = $crud->render();
        $output->func = "Vehicle Movement Master";

        $this->load->view('layout.php',$output);
    }
        
    public function personalexpense()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('personal_expense_master')
            ->set_subject('Pers. Expense Master')
            ->columns("user_id","phoneno","biling_cycle_from","biling_cycle_to","reminder")
            
            ->display_as('user_id','Employee Name')
            ->display_as('phoneno','Mobile')
            ->display_as('biling_cycle_from','Billing Cycle From')
            ->display_as('biling_cycle_to','Billing Cycle To')
            ->display_as('reminder','Reminder');            
	
        $crud->fields("user_id","phoneno","biling_cycle_from","biling_cycle_to","reminder");               
        $crud->required_fields("user_id","phoneno","biling_cycle_from","biling_cycle_to","reminder");
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
            ->set_subject('Properties Master')
            ->columns("name","address","elec_biling_cycle_from","elec_biling_cycle_to","water_biling_cycle_from","water_biling_cycle_to","htax_biling_cycle_from","htax_biling_cycle_from","rented","reminder")
            
            ->display_as('name','Property Name')
            ->display_as('address','Property Address')
            ->display_as('elec_biling_cycle_from','Elect. Billing Cycle From')
            ->display_as('elec_biling_cycle_to','Elect. Billing Cycle To')
            ->display_as('water_biling_cycle_from','Water Billing Cycle From')
            ->display_as('water_biling_cycle_to','Water Billing Cycle To')
            ->display_as('htax_biling_cycle_from','H. Tax Billing Cycle From')
            ->display_as('htax_biling_cycle_to','H. Tax Billing Cycle To')           
            ->display_as('rented','Rented')
            ->display_as('reminder','Reminder');            
	
            
        $crud->fields("name","address","elec_biling_cycle_from","elec_biling_cycle_to","water_biling_cycle_from","water_biling_cycle_to","htax_biling_cycle_from","htax_biling_cycle_from","rented","reminder");
               
        $crud->required_fields("name","address","elec_biling_cycle_from","elec_biling_cycle_to","water_biling_cycle_from","water_biling_cycle_to","htax_biling_cycle_from","htax_biling_cycle_from","rented","reminder");
        
        /*$crud->callback_add_field('rented',array($this,'add_checkbox_rented'));
        $crud->callback_edit_field('rented',array($this,'edit_checkbox_rented'));                
                
        $crud->callback_add_field('reminder',array($this,'add_checkbox_reminder')); 
        $crud->callback_edit_field('reminder',array($this,'edit_checkbox_reminder'));                
                        
        */
        $output = $crud->render();
        $output->func = "Property Master";

        $this->load->view('layout.php',$output);
    }
        
    public function vehicletax()
    {

        $crud = new grocery_CRUD();

        $crud->set_table('vehicle_tax_master')
            ->set_subject('Vehicle Taxes')
            ->columns("vehicle_id","taxtype_id","date_from","date_to","amount_paid","amount_received","attachment")
            ->display_as('vehicle_id','Vehicle Name')
            ->display_as('taxtype_id','Tax Type')
            ->display_as('date_from','Date From')
            ->display_as('date_to','Date To')
            ->display_as('amount_paid','Amount Paid')
            ->display_as('amount_received','Receipt Received')
            ->display_as('attachment','Tax Receipt');
	
            
        $crud->fields("vehicle_id","taxtype_id","date_from","date_to","amount_paid","amount_received","attachment");
        $crud->set_rules('amount_paid','Amount Paid','required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
        $crud->required_fields("vehicle_id","taxtype_id","date_from","date_to","amount_paid","amount_received");
        
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

        $crud = new grocery_CRUD();

        $crud->set_table('vendor_master')
            ->set_subject('Vendor Details')
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

        $crud = new grocery_CRUD();

        $crud->set_table('company_master')
            ->set_subject('Company Details')
            ->columns("name","address","telephone","contact_person","contact_mobile","gst_no","pan_no","logo")
            ->display_as('name','Name')
            ->display_as('address','Address')
            ->display_as('telephone','Telephone')
            ->display_as('gst_no','GST No.')
             ->display_as('pan_no','PAN No.')
            ->display_as('logo','Logo')
            ->display_as('contact_person','Contact Person')
            ->display_as('contact_mobile','Contact Mobile');

        $crud->fields('name','address','telephone','contact_person','contact_mobile','gst_no',"pan_no",'logo');
        $crud->set_field_upload('logo','assets/uploads/files');
        //$crud->required_fields('firstName','lastName');
        $crud->required_fields('name','address','mobile','gst_no','pan_no');
        $output = $crud->render();

        $output->func = "Company Master";

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
            
            
        $crud->set_field_upload('policy_copy','assets/uploads/files');  

        $crud->fields("companyname","vehicle_id","date_from","date_to","amount","assigned_to","policy_copy");
        $crud->required_fields("companyname","vehicle_id","date_from","date_to","amount","policy_copy");
        $crud->set_relation('assigned_to','user_master','name');
        
        $crud->set_relation('vehicle_id','vehicle_master','vehicle_no');
        
        
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
            ->columns("vehicle_no","description","reg_authority","make","model","chasis_no","engine_no","permit_type","purchase_date","rc_copy","sold")
            ->display_as('vehicle_no','Vehicle No.')
            ->display_as('description','Description')
            ->display_as('reg_authority','Regulatory Authority')
            ->display_as('make','Make')
            ->display_as('model','Model')
            ->display_as('chasis_no','Chasis No')
            ->display_as('engine_no','Engine No.')
            ->display_as('permit_type','Permit Type')            
            ->display_as('purchase_date','Purchase Date')
            ->display_as('sold','Sold(Y/N)')
            ->display_as('rc_copy','RC Copy');
            
           $crud->set_field_upload('rc_copy','assets/uploads/files');

        $crud->fields("vehicle_no","description","reg_authority","make","model","chasis_no","engine_no","permit_type","purchase_date","sold","sold_to","address","mobile","sale_date","rc_copy");
        //$crud->required_fields('firstName','lastName');
        $crud->set_relation('permit_type','permit_master','permit');
        
        $crud->required_fields("vehicle_no","description","reg_authority","make","model","chasis_no","engine_no","purchase_date","rc_copy");
        
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
            ->columns("item")
            ->display_as('item','Item Name');

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
            redirect("main/login/2");
        }

    }


}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */
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

class Nav extends CI_Controller
{
    public $tableName= array();

    public function __construct()
    {
        parent::__construct();

        $this->load->library('Crud',$this->tableName);
    }

    public function index(){

        $this->tableName[] ="company_master";

        $crud = new Crud($this->tableName);

        $crud->set_table('company_master');
        $crud->set_subject('Company Details')
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



}
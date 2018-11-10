<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

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
        $this->checkLogin();


    }

    public function index()
    {

        $userData = $this->session->userdata("user");
        //var_dump($userData); exit;
        if ($userData!=NULL && $userData->id > 0) {
            // echo "You are logged in "; exit;

            if($userData->id == 1){

                $users = $this->permissions_model->getAllUsers();
                $output = $this->load->view("permissions/users",array("users"=>$users),TRUE);
                $this->load->view('dashboard.php',array("output"=>$output));

            } else {
                $output = "You are not authorised personel for this action ";
                $this->load->view('dashboard.php',array("output"=>$output));

            }


        } else {
            redirect("login/index/2");
            return;
        }

       // var_dump($users); exit;
    }

    private function loadTables(){
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

        return $tables;
    }



    public function userpermission($userId){

         $rights=    $this->permissions_model->loadUserRights($userId);

         //echo"<pre>";
         //var_dump($rights); exit;

        $perview = $this->load->view('permissions/userpermission.php',array("rights"=>$rights),TRUE);

        $this->load->view('dashboard.php',array("output"=>$perview));
        return;

    }

    public function updateaction(){
       // var_dump($_POST); exit;
        //$_POST['data'] = "vendor_master###6###is_list";
        //$_POST['choice']="Yes";

        $dataArray= explode("###",$_POST['data']);

        $tableName = $dataArray[0];
        $userId = $dataArray[1];
        $action = $dataArray[2];
        $choice = $_POST['choice'];
        $ret = $this->permissions_model->updateRight($tableName,$userId,$action,$choice);
        $result = array();
        $result['result']="FAIL";
        if($ret){
            $result['result']  = "SUCCESS";
        }

        $this->load->view('permissions/updateaction.php',$result);

    }



    private function checkLogin()
    {

        $user = $this->session->userdata('user');
        if (!isset($user->id)) {
            redirect("login/index/2");
        }

    }



}


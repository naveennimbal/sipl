<?php
/**
 * Created by PhpStorm.
 * User: naveen
 * Date: 26/10/18
 * Time: 10:21 PM
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! ini_get('date.timezone') )
{
    date_default_timezone_set('Asia/Kolkata');
}
class Porder extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('users_model');
        $this->load->model('Porder_model');
        /* ------------------ */

        // $this->load->library('grocery_CRUD');

    }

    public function index($msg="")
    {
        // echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
        //die();
        if($msg==0 && $msg!=""){$msg="invalid Username or Password ";}
        if($msg==2){$msg="Your are not logged in  ";}
        if($msg==3){$msg="Your are securely logged out   ";}

        $orders = $this->Porder_model->getOrders();

        $list = $this->load->view('po/index.php',array("orders"=>$orders),TRUE);

        $this->load->view('dashboard.php',array("output"=>$list));
       // $this->load->view('po/index.php',array("msg"=>$msg));
    }

     public function add()
    {
        if($_POST){
            //var_dump($_POST); exit;
            $data = array();
            $date = date('Y-m-d',strtotime($_POST['po_date']));

            //var_dump($date); exit;
            $data['po_no'] = $_POST['po_no'];
            $data['po_date']= $date;
            $data['vendor_id']  = $_POST['vendor'];
            $data['vendor_bank_id'] = $_POST['vendor_bank'];
            $data['site_address']  = $_POST['site_address'];
            $data['ship_to']= $_POST['shipping_address'];
            $data['remarks']= $_POST['remarks'];
            $id = $this->Porder_model->addOrder($data);

            //var_dump($id);
            redirect('porder');
            return;

        } else {

            $vendors = $this->Porder_model->getVendors();

            $list = $this->load->view('po/add.php', array("vendors" => $vendors), TRUE);

            $this->load->view('dashboard.php', array("output" => $list));
            // $this->load->view('po/index.php',array("msg"=>$msg));
        }
    }






    public function vendorbank(){

        $vendorId = $_POST['vendorID'];
        //$vendorId = 1;

        $banks = $this->Porder_model->getVendorBanks($vendorId);
        $bankArr = array();

        foreach ($banks as $bank) {
            $bankArr[] = $bank;
            //$bankArr['bank_name'][] = $bank->bank_name;
        }

        echo json_encode($bankArr); exit;

    }

    public function additems($poID){


        if($_POST){
            //rint_r($_POST); exit;

            


        } else {


            $poDetail = $this->Porder_model->getOrderDetails($poID);

            //var_dump($poDetails); exit;

            $this->load->view('po/items.php', array("podetail" => $poDetail));

            //echo json_encode($bankArr); exit;
        }

    }








}
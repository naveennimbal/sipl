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
            //print_r($_POST); exit;


            $res= array();
            $res['result']= "FAIL";
            $po_id = $_POST['poid'];
            $this->Porder_model->deletePreviousOrderItems($po_id);
            $res['result']= "DELETESUCCESS";
            $x = 0;
            if(isset($_POST['part_number'])) {
                $res['result']= "FAIL";
                for ($i = 0; $i < count($_POST['part_number']); $i++) {
                    //foreach ($_POST as $data=>$v){

                    //var_dump($data);
                    $data['po_id'] = $po_id;
                    $data['part_no'] = $_POST['part_number'][$i];
                    $data['part_name'] = $_POST['part_name'][$i];
                    $data['quantity'] = $_POST['quantity'][$i];
                    $data['price'] = $_POST['price'][$i];

                    $amount = ($_POST['quantity'][$i] * $_POST['price'][$i]);
                    $data['amount'] = $amount;


                    $this->Porder_model->addOrderItems($data);
                    // echo "part_number= $part_no-----part_name=$part_name-------quan= $quantity--------Price= $price\n";
                    if ($x < count(count($_POST['part_number']))) {
                        $res['result'] = "SUCCESS";
                    }
                    $x++;

                }
            }

            echo json_encode($res);
            return;


        } else {


            $poDetail = $this->Porder_model->getOrderDetails($poID);
            $transactions = $this->Porder_model->getOrderTransactions($poID);

            //var_dump($poDetails); exit;

            $this->load->view('po/items.php', array("podetail" => $poDetail,"transaction"=>$transactions));

            //echo json_encode($bankArr); exit;
        }

    }


    public function poview($po_id){

        $poDetail = $this->Porder_model->getOrderDetails($po_id);
        $transactions = $this->Porder_model->getOrderTransactions($po_id);

        $this->load->view('po/poview.php', array("podetail" => $poDetail,"transaction"=>$transactions));

    }







}
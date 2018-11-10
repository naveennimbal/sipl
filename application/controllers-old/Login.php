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
class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('users_model');
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
            redirect('/login/index/0');
        }

    }


    public function logout(){

        $this->session->sess_destroy();
        redirect('/login/index/3');

    }



}
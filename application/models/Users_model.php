<?php
/**
 * Created by PhpStorm.
 * User: naveen
 * Date: 24/10/18
 * Time: 7:33 PM
 */

class users_model  extends CI_Model  {

    public function getUserData($userId){

        $query=$this->db->query("select * from user_master where id = $userId");
        return $query->result();

    }

    public function userLogin($username,$password){
       // echo "select * from user_master where user_name = '".$username."' and password='".$password."'";
        //exit;
        $query=$this->db->query("select * from user_master where user_name = '".$username."' and password='".$password."'");
        $numrows = $query->num_rows();
       // var_dump($numrows); exit();

        $result = $query->result();
        $return['isLogin'] = "FAIL";
        if($numrows==1){
            //var_dump($result); exit;
            $return['isLogin']="SUCCESS";
            $return['userData']=$result;

        }

        return $return;

    }



}

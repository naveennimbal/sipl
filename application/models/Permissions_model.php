<?php
/**
 * Created by PhpStorm.
 * User: naveen
 * Date: 24/10/18
 * Time: 7:33 PM
 */

class Permissions_model  extends CI_Model  {

    public function getUserData($userId){

        $query=$this->db->query("select * from user_master where id = $userId");
        return $query->result();

    }

    public function checkPermission($userId,$tableName){

        $query=$this->db->query("select * from permissions where user_id = '".$userId."' and table_name='".$tableName."'");
        $numrows = $query->num_rows();
        // var_dump($numrows); exit();
        $result = $query->result();

        return $result;

    }


    public function getAllUsers(){
        $query = $this->db->query("SELECT * from user_master WHERE id !=1 ");
        $result = $query->result();

        return $result;


    }


    public function loadRights($table,$reference ,$userId,$username){
        $qry = "INSERT INTO permissions(table_name,table_reference,user_id,user_name) values ('".$table."','".$reference."','".$userId."','".$username."')";
        $query = $this->db->query($qry);
        return;
    }


    public function loadUserRights($userId){
        $query=$this->db->query("select * from permissions where user_id = '".$userId."'");
        $numrows = $query->num_rows();
        // var_dump($numrows); exit();

        $result = $query->result();
        return $result;
    }


    public function updateRight($tableName,$userId,$action,$choice){
        $qrystr = "UPDATE permissions SET ".$action."='".$choice."' WHERE user_id = ".$userId." AND table_name='".$tableName."'";
        $this->db->query($qrystr);
        return TRUE;

    }




    public function userLogin($username,$password){
        // echo "select * from user_master where user_name = '".$username."' and password='".$password."'";
        //exit;
        $query=$this->db->query("select * from permissions where user_name = '".$username."' and password='".$password."'");
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


    /*
     * This is for the Dashboard  not creating anther model
     * This is just get the rou count of the transsactional table So we can show up on the dashboardr
     *
     *
     * */

    public function getDashboard(){

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


        $result = array();

        $result['Company']['link'] = "main/company";
        $result['Material']['link'] = "main/material";
        $result['UOM']['link'] = "main/uom";
        $result['Vehicle']['link'] = "main/vehiclemaster";
        $result['Vehicle Policy']['link'] = "main/policies";
        // $tables['Vehicle Policy'] = "vehicle_policy_master";
        $result['Vehicle Taxation']['link'] = "main/vehicletax";
        $result['Vendor']['link'] = "main/vendor";
        $result['Vendor Bank']['link'] = "main/vendorbank";
        $result['Property']['link'] = "main/property";
        $result['Project']['link'] = "main/project";
        $result['Personal Expense']['link'] = "main/personalexpense";




        $result['Company']['class'] = "fa-building";
        $result['Material']['class'] = "fa-bullseye";
        $result['UOM']['class'] = "fa-cubes";
        $result['Vehicle']['class'] = "fa-car";
        $result['Vehicle Policy']['class'] = "fa-files-o";
        // $tables['Vehicle Policy'] = "vehicle_policy_master";
        $result['Vehicle Taxation']['class'] = "fa-edit";
        $result['Vendor']['class'] = "fa-money";
        $result['Vendor Bank']['class'] = "fa-certificate";
        $result['Property']['class'] = "fa-building-o";
        $result['Project']['class'] = "fa-check-square";
        $result['Personal Expense']['class'] = "fa-file-text-o";




        foreach ($tables as $table=>$tableName){

            $query=$this->db->query("select count(*) as row_count from  $tableName");
            $rows = $query->row();
            //var_dump($comapny_rows->row_count); exit;
            $result[$table]['count'] = $rows->row_count;
            $result[$table]['color'] = "#".dechex(rand(0x000000, 0xFFFFFF));

        }
            return $result;

        //$result['Company']


    }



}

<?php
/**
 * Created by PhpStorm.
 * User: naveen
 * Date: 15/11/18
 * Time: 10:30 PM
 */

class Porder_model  extends CI_Model  {

    public function getVendors(){

        $query=$this->db->query("select * from vendor_master" );
        $numrows = $query->num_rows();
        // var_dump($numrows); exit();
        $result = $query->result();

        return $result;

    }


    public function getVendorBanks($vendorId){

        $query=$this->db->query("select id , bank_name from vendor_bank_master where vendor_id = $vendorId" );
        $numrows = $query->num_rows();
        // var_dump($numrows); exit();
        $result = $query->result();

        return $result;

    }


    public function addOrder($data){
        $sql  = "INSERT INTO purchase_order_master po_no ='".$data['po_no']."' ,po_date ='".$data['po_date']."',vendor_id ='".$data['vendor_id']."',vendor_bank_id ='".$data['vendor_bank_id']."' ,site_address  ='".$data['site_address']."',ship_to ='".$data['ship_to']."'";

    }

}
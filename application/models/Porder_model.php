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


    public function getOrders(){

        $query=$this->db->query("select po.id,po_no,po.po_date,ven.name from purchase_order_master po join vendor_master ven on po.vendor_id=ven.id " );
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
        $sql  = "INSERT INTO purchase_order_master SET po_no ='".$data['po_no']."' ,po_date ='".$data['po_date']."',vendor_id ='".$data['vendor_id']."',vendor_bank_id ='".$data['vendor_bank_id']."' ,site_address  ='".$data['site_address']."',ship_to ='".$data['ship_to']."',remarks='".$data['remarks']."' ";
       // $sql = "INSERT INTO purchase_order_master  SET "
        $this->db->query($sql);
        $inserId = $this->db->insert_id();
        return $inserId;

    }


    public function getOrderDetails($poid){

        $query=$this->db->query("select * from purchase_order_master  where id = $poid" );
        $row = $query->row();
        // var_dump($numrows); exit();
        //$result = $query->result();

        return $row;

    }

    public function getOrderTransactions($poid){
        $qry = "SELECT pom.id as po_id , pom.po_date , pom.site_address,pom.ship_to as shipping_address,pot.id as pot_id,pot.qty as quantity ,pot.rate as price ,pot.amount,pot.part_name,pot.part_no from purchase_order_transaction pot 
right join purchase_order_master pom on pom.id = pot.purchase_order_id where pot.purchase_order_id = $poid";

        $query=$this->db->query($qry);
        //$row = $query->row();
        // var_dump($numrows); exit();
        $result = $query->result();

        return $result;
    }


    public function addOrderItems($data){
        $query = "INSERT INTO purchase_order_transaction SET ";
        $query .= "purchase_order_id =". $data['po_id'];
        $query .= ",part_no ='". $data['part_no']."'";
        $query .= ",part_name ='". $data['part_name']."'";
        $query .= ",rate =". $data['price'];
        $query .= ",qty =". $data['quantity'];
        $query .= ",amount =". $data['amount'];

       // echo  $query; exit();

        $this->db->query($query);
        $inserId = $this->db->insert_id();
        return $inserId;
    }


    public function deletePreviousOrderItems($po_id){
        $this->db->query("select * from purchase_order_transaction where purchase_order_id = $po_id" );
        return;

    }


    public function getOrdersItem($po_id)
    {
        $qry = "SELECT DISTINCT(pot.id) as trans_id , pom.id as po_id,pom.site_address,pom.ship_to as shipping_address, vendor_master.name as vendor_name,vendor_bank_master.bank_name as bank_name,
                pom.created_on as po_date,pot.rate as price,pot.qty as quantity , pot.amount  
                FROM purchase_order_master pom 
                join purchase_order_transaction pot on pom.id = pot.purchase_order_id 
                join vendor_master on pom.vendor_id = vendor_master.id 
                left join vendor_bank_master on vendor_bank_master.id = pom.vendor_bank_id 
                WHERE po.id = $po_id";

        $query=$this->db->query($qry);
        //$numrows = $query->num_rows();
        // var_dump($numrows); exit();
        $result = $query->result();

        return $result;


    }

}
<?php
/**
 * Created by PhpStorm.
 * User: naveen
 * Date: 20/11/18
 * Time: 11:21 PM
 */


class  material_model  extends CI_Model  {




    public function getMaterials(){

        $query=$this->db->query("select * from material_master");
        $numrows = $query->num_rows();
        // var_dump($numrows); exit();

        $result = $query->result();

        return $result;

    }






}

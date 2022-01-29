<?php

//Use to fetch product data
class Product
{
    public $db=null;
    public function __construct(DBController $db){
        if(!isset($db->connection)) return null;
        $this->db=$db;
    }

    //fetch product data using getData Method

    public function getData($table= 'product'){
        $result=$this->db->connection->query("SELECT * FROM {$table}");
        $resultArray=array();
        while($item=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $resultArray[]=$item;
        }
        return $resultArray;
    }

    //get data using item_id
    public function getProduct($item_id=null,$table='product'){
        if(isset($item_id))
        {
            $result=$this->db->connection->query("SELECT * FROM {$table} WHERE (item_id={$item_id})");
            $resultArray=array();
            while($item=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                $resultArray[]=$item;
            }
            return $resultArray;
        }
    }
}
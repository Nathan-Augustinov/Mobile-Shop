<?php

//php wishlist class
class Wishlist
{
    public $db=null;
    public function __construct(DBController $db){
        if(!isset($db->connection)) return null;
        $this->db=$db;
    }

    //insert into cart table
    public function InsertIntoWishlist($params=null,$table='wishlist')
    {
        if($this->db->connection!=null)
        {
            if($params!=null)
            {
                //get table columns
                $columns=implode(',',array_keys($params));
                $values=implode(',',array_values($params));

                //create sql query
                $query_string=sprintf("INSERT INTO %s(%s) VALUES(%s)",$table,$columns,$values);
                
                //execute query
                $result=$this->db->connection->query($query_string);
                return $result;
            }
        }
    }

    //to get the user_id and item_id and insert into cart table
    public function addToWishlist($userid,$itemid)
    {
        if(isset($userid) && isset($itemid))
        {
            $params=array(
                "user_id"=>$userid,
                "item_id"=>$itemid
            );
            //insert data into cart
            $result=$this->InsertIntoWishlist($params);
            if($result){
                //reload page
                header("Location:".$_SERVER['HTTP_REFERER']);
            }
        }
    }

    
    //delete item from cart using cart item id
    public function deleteFromWishlist($item_id=null,$user_id=null,$table='wishlist'){
        if($item_id!=null && $user_id!=null){
            $result=$this->db->connection->query("DELETE FROM {$table} WHERE (item_id={$item_id} AND user_id={$user_id})");
            if($result){
                header("Location:".$_SERVER['PHP_SELF']);
            }
            return $result;
        }

    }
}
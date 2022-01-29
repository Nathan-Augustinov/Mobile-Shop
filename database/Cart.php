<?php

//php cart class
class Cart
{
    public $db=null;
    public function __construct(DBController $db){
        if(!isset($db->connection)) return null;
        $this->db=$db;
    }

    //insert into cart table
    public function InsertIntoCart($params=null,$table='cart')
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
    public function addToCart($userid,$itemid)
    {
        if(isset($userid) && isset($itemid))
        {
            $params=array(
                "user_id"=>$userid,
                "item_id"=>$itemid
            );
            //insert data into cart
            $result=$this->InsertIntoCart($params);
            if($result){
                //reload page
                
                header("Location:".$_SERVER['HTTP_REFERER']);
            }
        }
    }

    //delete item from cart using cart item id
    public function deleteFromCart($item_id=null,$user_id=null,$table='cart'){
        if($item_id!=null && $user_id!=null){
            $result=$this->db->connection->query("DELETE FROM {$table} WHERE (item_id={$item_id} AND user_id={$user_id})");
            if($result){
                header("Location:".$_SERVER['PHP_SELF']);
            }
            return $result;
        }

    }

    //calculate subtotal
    public function getSum($arr)
    {
        if(isset($arr)){
            $sum=0;
            foreach($arr as $item){
                $sum+=floatval($item[0]);
            }
            return sprintf('%.2f',$sum);
        }

        
    }

    //get item id of shopping cart list
    public function getCartId($cartArray=null,$key="item_id"){
        if($cartArray!=null)
        {
            $cart_id=array_map(function($value) use ($key){
                return $value[$key];
            },$cartArray);
            return $cart_id;
        }
    }

    //save for later
    public function saveForLater($item_id=null,$user_id=null,$saveTable="wishlist",$fromTable="cart")
    {
        if($item_id!=null && $user_id!=null){
            $query="INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE (item_id={$item_id} AND user_id={$user_id});"; 
            $query .="DELETE FROM {$fromTable} WHERE (item_id={$item_id} AND user_id={$user_id});";

            //execute multiple query
            $result=$this->db->connection->multi_query($query);
            if($result)
            {
                header("Location:" .$_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    //get data using item_id
    public function getProductCart($user_id=null,$table='cart'){
        if(isset($user_id))
        {
            $result=$this->db->connection->query("SELECT * FROM {$table} WHERE  user_id={$user_id}");
            $resultArray=array();
            while($item=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                $resultArray[]=$item;
            }
            return $resultArray;
        }
    }
   
}

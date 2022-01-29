<?php

class DBController
{
    //Database Connection Properties
    protected $host='localhost';
    protected $user='root';
    protected $password='';
    protected $database="mobileshop";


    //connection property
    public $connection=null;

    //constructor
    public function __construct(){
        $this->connection=mysqli_connect($this->host,$this->user,$this->password,$this->database);
        if($this->connection->connect_error){
            echo "Fail".$this->connection->connect_error;
        }
        //echo "Connection successful";
    }

    public function __destruct()
    {
        $this->closeConnection();
    }
    // for mysql closing connection
    protected function closeConnection(){
        if($this->connection !=null){
            $this->connection->close();
            $this->connection=null;
        }
    }
}


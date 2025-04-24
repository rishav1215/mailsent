<?php
class Db
{
    public $connect;
    public $hostname = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "ecommerce";

    public function __construct()
    {
        $this->connect = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        if ($this->connect->connect_error) {
            die("Connection failed: " . $this->connect->connect_error);
        }
    }
}
    class crud extends Db{
        public function __construct()
        {
            parent::__construct();
        }
        public function insertData($table, $query){
            $this->connect->query("INSERT INTO $table $query");

        }
        public function callingData($table){
            $this->connect->query("SELECT * FROM $table");
            
        }
         public function redirect($location){
            echo "<script>window.open('$location', '_self')</script>";
         }
         public function message($message){
            echo "<script>alert($message)</script>";
         }
         public function deleteData($table, $id){
            $this->connect->query("DELETE FROM $table WHERE id = '$id'");
         }
    }
?>
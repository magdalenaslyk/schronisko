<?php
class Db {
    public $url = "localhost";
    public $login = "root";
    public $pass = "";
    public $db_name = "schronisko";
    
    public $conn;

    function __construct(){
        $this->conn = new mysqli($this->url, $this->login, $this->pass, $this->db_name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function query($query) {
        $result = $this->conn->query($query);
        $arr = [];
        if ($result->num_rows > 0 && $result) {
            while($row = $result->fetch_assoc()) {
                array_push($arr, $row);
            }
            return $arr;
        } else {
           return NULL;
        }
    }
}
?>
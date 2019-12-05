<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
$root = "http://" . $_SERVER['HTTP_HOST'];
$root .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$constants['base_url'] = $root;
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'schronisko');
define('SITE_URL', $constants['base_url']);
 

class DBConnection {
    private $_con;
    function __construct(){
        $this->_con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);      
        if ($this->_con->connect_error) die('Database error -> ' . $this->_con->connect_error);
    }
    // return Connection
    function returnConnection() {
        return $this->_con;
    }
}
?>
<?php
class DbConfig 
{ 

// headers: {
//     "Access-Control-Allow-Origin": "*",
//     "Access-Control-Allow-Methods": "GET,PUT,POST,DELETE,PATCH,OPTIONS"
//   }

    private $_host = 'localhost';
    private $_username = 'u835423254_smtp_mail';
    private $_password = '/jB1ad1FW/';
    private $_database = 'u835423254_smtp_mail';
    public $connection;
    
    public function __construct()
    {
        if (!isset($this->connection)) 
        {
        
$this->connection =
 new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
        
            if (!$this->connection) {
            echo 'Cannot connect to database server';
            exit;
            }            
        }    
        
       return $this->connection;
    }
}
?>
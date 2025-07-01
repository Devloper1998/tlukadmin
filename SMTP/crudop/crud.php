<?php
include_once 'dbconfig.php';
 
class Crud extends DbConfig
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getData($query)
    {        
        $result = $this->connection->query($query);
        
        if ($result == false) 
        {
            return false;
        } 
        
        $rows = array();
        
        while ($row = $result->fetch_assoc()) 
        {
            $rows[] = $row;
        }
        
        return $rows;
    }
        
    public function execute($query) 
    {
        //echo $query;
        $result = $this->connection->query($query);
        
        if ($result == false) {
            //echo 'Error: cannot execute the command due to improper Syntax';
            return false;
        } else {
            return true;
        }        
    }

    public function insertLastId($query) 
    {
        $result = $this->connection->query($query);
        
        if ($result == false) {
            //echo 'Error: cannot execute the command due to improper Syntax';
            return 0;
        } else {
           return  $this->connection->insert_id;
        }        
    }
    
    public function delete($id, $table) 
    { 
        $query = "DELETE FROM $table WHERE id = $id";
        
        $result = $this->connection->query($query);
    
        if ($result == false) {
           // echo 'Error: cannot delete Record';
            return false;
        } else {
            return true;
        }
    }
 
    public function escape_string($value)
    {
        return $this->connection->real_escape_string($value);
    }
}
?>
<?php
namespace Database;
include __DIR__ .'/../config.php';

class Controller {
    private $servername = "";
    private $username = "";
    private $password = "";
    private $dbname = "";       

    public function __construct() {
        $config = new \Config();
        $this->servername =  $config->SQL_SERVER_NAME;
        $this->username = $config->SQL_SERVER_USERNAME;
        $this->password = $config->SQL_SERVER_PASSWORD;
        $this->dbname = $config->DB_NAME;    
    }
    
    public function SelectFrom($select,$from){
        return $this->Run("SELECT ".$this->ParseArray($select,[","])." FROM ".$from);
    }

    public function SelectFromWhere($select,$from,$where){
        return $this->Run("SELECT ".$this->ParseArray($select,[","])." FROM ".$from." WHERE ".$this->ParseArray($where,["=\"","\" AND "])."\"");
    }

    public function __call($method, $arguments) {
        if($method == 'Select') {
            if(count($arguments) == 2) {
               return call_user_func_array(array($this,'SelectFrom'), $arguments);
            }
            else if(count($arguments) == 3) {
               return call_user_func_array(array($this,'SelectFromWhere'), $arguments);
            }
        }
    }   

    function Run($sql){
        // Create connection
        $conn = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    
        $results = Array();
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                array_push($results,$row);
            }
        }
        $conn->close();
        return $results;
    }

    function ParseArray($array,$separators){
        $result = "";
        $index = 0;
        
        for ($i = 0; $i < count($array); $i++)  {
            $item = preg_replace('/[^a-zA-Z0-9]/', '',$array[$i]);
            $result = $result.$item;
            if($i < count($array) - 1){
                $result = $result.$separators[$index];
            }
            $index++;
            if($index >= count($separators))
            {
                $index = 0;
            }
        }
        return $result;
    }
}
?>
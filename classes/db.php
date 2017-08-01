<?php

//the db class for connecting to the database
   
 
    
class db{

    public $conn;
    
    
    public function dbconfig(){
    
        $this->conn = null;

        try{
        
            $this->conn = new PDO("mysql:host=". config::getcreds("mysql/host") . ";dbname=". config::getcreds("mysql/dbname"), config::getcreds("mysql/username"),config::getcreds("mysql/password"));
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
         
            }
            catch(PDOException $ex){
                
                echo $ex->getMessage();

            }
            
            return $this->conn;

    }




}



?>
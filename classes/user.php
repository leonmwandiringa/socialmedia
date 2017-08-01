<?php 
     
    /* include_once "db.php";*/
// user for interacting with db and creating db methods for inscript use

    class user{

        private $conn;
    
        public function __construct(){

            $database = new db();
            
            $db = $database->dbconfig();
            $this->conn = $db;
        }

        public function runquery($sql, $params=array()){
        
            $kicho = $this->conn->prepare($sql);
            
            $kicho->execute($params);
            
            if(explode(" ",$sql)[0] == 'SELECT'){
            
                $results = $kicho->fetchAll(PDO::FETCH_OBJ);
            
            
            }
            
            return $kicho;

        }
        
        public function results(){
        
            return $this->results;
        
        }
        
        public function register($name, $surname, $email, $password, $token){
        
            try{
            
                $password = password_hash($password, PASSWORD_BCRYPT);
                
                $username = strtolower($name."".$surname);
                
                
                $kaboom = $this->conn->prepare("INSERT INTO users(name, surname, username, password, email, token) VALUES(:name, :surname, :username, :password, :email, :token)");
                
                $kaboom->execute(array(":name"=>$name, ":surname"=>$surname, ":username"=>$username, ":password"=>$password, ":email"=>$email, ":token"=>$token));
                
                return $kaboom;

                    
            }catch(PDOExcepetion $ex){
            
                echo "error". $ex->getMessage();
            
            
                }
            }
            
            public function isloggedin(){
            
                if(isset($_SESSION['usr'])){
                
                return true;
                }
   
            
            
            }
        
        public function login($email, $password){
        
            try{
            
                $kaboom = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
                
                $kaboom->execute(array(":email"=>$email));
                
                $stuff = $kaboom->fetch(PDO::FETCH_OBJ);
                
                if($kaboom->rowCount() == 1){
                
                    if($stuff->status == "Y"){
                        
                        if(password_verify($password, $stuff->password)){
                        
                            $_SESSION['usr'] = $stuff->userid;
                            return true;
                        
                        
                        }else{
                        
                        header("Location :index.php?nouser");
                    
                        }
                    
                    
                    
                    }else{
                    
                        header("Location: index.php?activate");
                    
                    }
                
                
                }
                else{
                
                    header("Location: index.php?nouser");
                
                }

            }catch(PDOException $ex){
            
                echo "error". $ex->getMessage();
            
            
            }

        
        }
        
        public static function sendMail($email, $body, $subject){
        
                $to = $email;
                $subject = $subject;
                $message = $body;
                $headers = "From: techadon.tech \r\n"."Reply-To: techadon.tech \r\n";
                
                mail($to, $subject, $message);
                        
            
        }
        

        public function lastid(){
        
            $kicho = $this->conn->lastInsertId();
            return $kicho;
        
        }
        
        public function logout(){
        
        
        session_destroy();
        $_SESSION['usr'] = false;
        
        }

        public function redirect($url){
        
        header("Location: $url");
        
        }


    }



?>
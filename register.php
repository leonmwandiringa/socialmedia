<?php
    
   require_once "init.php";
 
  

    $app = new user();
    
    if($app->isloggedin() != ""){
        
        $app->redirect("home.php");
    
    }
    
    //if buttton is clicked
    if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    
    //checing if email is valid
        if(sanity::emails($_POST['email'])){
        
        
            $email = sanity::emails($_POST['email']);
            $name = sanity::strings($_POST['name']);
            $surname = sanity::strings($_POST['surname']);
            
            //checking if the name and surname have valid characters
            if(!preg_match("/^[a-zA-Z]*$/",$name) || !preg_match("/^[a-zA-Z]*$/",$surname)){
            
            
            $msg = '
                    <div class="error">
                                        
                                        <p><strong> Error</strong> Your naming is wrong bro</p>
                                    
                                    </div>
    
                ';
      
            }else{
            
                $password = $_POST['password'];
                $token = md5(uniqid(rand()));
                
                $kaboom = $app->runquery("SELECT * FROM users WHERE email = :email", array(":email"=>$email));
                
                if($kaboom->rowCount() == 0){
                
                        if($app->register($name, $surname, $email, $password, $token)){
                        
                            /*$lastid = $app->lastid();
                            
                            $id = base64_encode($lastid);
                            
                            $subject = "user account activation";
                            
                            $message = "
                                        Hello $uname,
                                <br /><br />
                                Welcome to Coding Cage!<br/>
                                To complete your registration  please , just click following link<br/>
                                <br /><br />
                                <a href='http://www.SITE_URL.com/verify.php?id=$id&code=$token'>Click HERE to Activate :)</a>
                                <br /><br />
                                Thanks
                            
                            ";
                        
                            $app->sendmail($email, $subject, $message);*/
                            $msg = '
                                <div class="error">
                                                    
                                                    <p><strong> success</strong> you now good bro bro</p>
                                                
                                                </div>
                            ';
                            
                            $subject = "account activation";
                            
                            $body = "please activate your account in less than 24 hours to get activated";
                            
                            user::sendMail($email, $body, $subject);
                        
                        }else{
                        
                        
                            $msg = '
                                <div class="error">
                                                    
                                                    <p><strong> Error</strong> an error just occured bro</p>
                                                
                                                </div>
                            ';
                
                        }
                
                
                }else{
                
                
                    $msg = '
                        <div class="error">
                                            
                                            <p><strong> Error</strong> email aready exists bro.. just LOgin bro</p>
                                        
                                        </div>
                    ';
                    
                
                }
            
            
            
            }
            
            
        }else{
            
            $msg = '
                        <div class="error">
                                            
                                            <p><strong> error</strong> THa Fuck bro</p>
                                        
                                        </div>
                    ';
        
        
        }
  
    }
    
    /**/

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>  Mogino social media | Register</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/main.css">
        <link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel="stylesheet">
                    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
        <script src="assests/main.js"></script>
        
    </head>

    <body>
    
    <?php include "includes/header.php" ?>
    
    <div class="cont">
    
        <h1 class="header text-center" style="margin-top: 100px;"> Register and Enjoy</h1>
        <div class="loginform">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>" method="post" class="lorm">
            
            <?php if(isset($msg)){
            
            echo $msg;
            
            }
            
            ?>
            
            
                 <div class="formbunch">
                    <label class="labelfm"> Name</label>
                    <input type="text" class="formal" name="name" placeholder="Enter Your Name" required>
                </div>
                
                 <div class="formbunch">
                    <label class="labelfm"> SurName</label>
                    <input type="text" class="formal" name="surname" placeholder="Enter Your SurName" required>
                </div>
                
                <div class="formbunch">
                    <label class="labelfm"> Email Address</label>
                    <input type="email" class="formal" name="email" placeholder="Enter Your email address" required autocomplete="off">
                </div>
                
                <div class="formbunch">
                    <label class="labelfm"> Password</label>
                    <input type="password" class="formal" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="submitbutton" name="submit"> Register<button>
            </form>
        </div>

    </div>

    </body>
<html>
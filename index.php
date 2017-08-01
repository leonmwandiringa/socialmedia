<?php
    
   require_once "init.php";
   
   $app = new user();
   
   if($app->isloggedin() != ""){
   
   $app->redirect("home.php");
   
   }
   
   if(isset($_POST['submit'])){
   
        $email = $_POST['email'];
        $password = $_POST['password'];

        if($app->login($email,$password)){
            
            $app->redirect('home.php');
        
        }
   }

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>  Mogino social media</title>
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
    
   
    
        <h1 class="header text-center" style="margin-top: 100px;"> Login and Enjoy</h1>
        <div class="loginform">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>" method="post" class="lorm">
                                    
                                    <?php if(isset($_GET['nouser'])){ ?>
                                
                                <div class="error">
                                    
                                    <p><strong> Error</strong> Its either you pasword and email dont match.. just create another account bro</p>
                                
                                </div>
                            
                            
                            <?php } ?>
                            
                            <?php if(isset($_GET['activate'])){ ?>
                                
                                <div class="error">
                                    
                                    <p><strong> Error</strong> Please activate your account by clicking the link sent to your email</p>
                                
                                </div>
                            
                            
                            <?php } ?>
        
            
            
                <div class="formbunch">
                    <label class="labelfm"> Email Address</label>
                    <input type="email" class="formal" name="email" placeholder="Enter Your email address" required>
                </div>
                
                <div class="formbunch">
                    <label class="labelfm"> Password</label>
                    <input type="password" class="formal" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="submitbutton" name="submit"> Login<button>
            </form>
        </div>

    </div>

    </body>
<html>
<?php


    class errors{


        public static function display(){
        
            if(DISPLAY_ERRORS){
            
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
                
                
            }
            return false;
        }

    }

?>
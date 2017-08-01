
<?php

    class sanity{

        public static function strings($str){
        
            $sosa = trim($str);
            $sosa2 = stripslashes($sosa);
            $sosa3 = strip_tags($sosa2);
            $sosa4 = htmlspecialchars($sosa3);
            
            return $sosa4;
    
        }
        
        public static function emails($str){
            
            if(filter_var($str,FILTER_VALIDATE_EMAIL)){
            
            return $str;
            
            }
        
        return false;
        
        }
   
    }

?>
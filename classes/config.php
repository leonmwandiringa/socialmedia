<?php

//config class for splitting the creds input


class config{


    public static function getcreds($paths = null){

        if($paths){
            
            $creds = $GLOBALS['cred'];
            $paths = explode("/", $paths);
            
            foreach($paths AS $path){

                if(isset($creds[$path])){
                
                    $creds = $creds[$path];
                
                
                }
                
            
            }

            return $creds;
            
        }

        return false;
        
    }

}
?>
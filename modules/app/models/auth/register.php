<?php
        
        $packages = $_POST['next_step'];  
        if ($packages == "package1") {          
            $package = '1';      
        }elseif($packages == "package2"){
            $package = '2'; 
        }elseif($packages == "package3"){
            $package = '3'; 
        }else{
            $errors[] = 'Morate izabrati jedan od paketa!';
        }
             
        

    
?>




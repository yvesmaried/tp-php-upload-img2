<?php
$accountArray = array(
    //guest -> soleil123 / admin -> lapinpgm
    'guest' => '$2y$10$52wALyD7c7yQP/AxPq5aIOl42jtGaty6W0BTpGWOd63P6JO3qOLd2', 
    'admin' => '$2y$10$VMNF015TJSlHr5h4UIUa4e8tfidgYwoXuouCnxbQGILMCTw2Iv6iO'
);
$message = "";
$maxSize = 1 * 1024 * 1024;
$maxFolderSize = 40 * 1024 * 1024;

if (isset($_POST["account"]) && isset($_POST["password"]) ) {
    if ($_POST["account"] == "guest"){
        if (password_verify( $_POST["password"] , $accountArray["guest"] )){
            //login et mdp OK (guest)
            $message = "OK guest";

        } else {
            $message = "login ou mot de passe incorect";
        };
    }else if($_POST["account"] == "admin"){
        if (password_verify( $_POST["password"] , $accountArray["admin"] )){
            //login et mdp OK (admin)          
            $message = "OK admin";
        
        } else {
            $message = "login ou mot de passe incorect";
        };
    }else{
        $message = "login ou mot de passe incorect";
    }
    
};
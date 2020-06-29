<?php
if(!(isset($_SESSION['admin']) || isset($_SESSION['guest']))){
    header("location:no-allowed.php"); // redirection
    exit; // arrêt du script
};
$fileArray = scandir('upload');
array_shift($fileArray);
array_shift($fileArray);
<?php
if(isset($_SESSION['admin']) || isset($_SESSION['guest'])){
    header("location:gallery.php"); // redirection
    exit; // arrêt du script
};
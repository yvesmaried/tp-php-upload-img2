<?php
if (isset($_SESSION["guest"]) || isset($_SESSION["admin"]) ){
    session_destroy();
};
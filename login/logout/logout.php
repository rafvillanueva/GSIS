<?php

if(isset($_GET['logout'])){
    ob_start();
    session_start();
    session_unset();
    session_destroy();
    header("location: ../../");
}

?>
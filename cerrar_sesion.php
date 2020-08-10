<?php
    include_once "conexion.php";
    session_start();

    session_destroy();
    header('location:index.php');
?>
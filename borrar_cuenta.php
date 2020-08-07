
<?php
    include_once "conexion.php";
    session_start();


    $sql = "DELETE FROM personas WHERE Usuario = ?;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($_SESSION['usuario']));
    unset($_POST);
    session_destroy();
    header('location:index.php');    

?>
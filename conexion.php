<?php
    $link = 'mysql:host=localhost;dbname=poyofy';
    $usuario = 'root';
    $password = '';

    try{
        $pdo = new PDO($link,$usuario,$password);

    }catch (PDOException $e){
        print "Error: " . $e->getMessage() . "<br/>";
        die();
    }
?>
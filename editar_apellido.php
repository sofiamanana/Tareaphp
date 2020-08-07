<?php
    include_once "conexion.php";
    session_start();

    $sql = "SELECT * FROM personas WHERE Usuario = ?;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($_SESSION['usuario']));
    $sen = $sentencia->fetchAll();

    $id_persona = $sen[0]['ID_PERSONA'];

    if(isset($_POST['nuevo_apellido'])){
        $nuevo_apellido = $_POST['nuevo_apellido'];

        $sql = "UPDATE `personas` SET Apellido = ? WHERE ID_PERSONA = ?;";
        $sentencia = $pdo->prepare($sql);
        $sentencia->execute(array($nuevo_apellido,$id_persona));

        $_SESSION['password'] = $nuevo_apellido;
        header('location:editar_cuenta.php');

        
    }
    unset($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">  
    <link rel="shortcut icon" href="kirby.png"/>
    <title>Poyofy</title>
</head>
<body>
    <div id="titleN">
        <h1>Poyofy Editar Usuario</h1>
    </div>
    <div class="center">
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Ingrese una nuevo apellido:</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" name="nuevo_apellido">
            </div>         
            <button type="submit" class="butn btn-primary mt-3">Actualizar</button>   
        </form>
    </div>    
</body>
</html>
<?php
    include_once "conexion.php";
    session_start();

    $sql = "SELECT * FROM personas WHERE Usuario = ?;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($_SESSION['usuario']));
    $sen = $sentencia->fetchAll();

    $id_persona = $sen[0]['ID_PERSONA'];

    if(isset($_POST['nueva_contra'])){
        $nueva_contra = $_POST['nueva_contra'];

        $sql = "UPDATE `personas` SET `Password` = ? WHERE ID_PERSONA = ?;";
        $sentencia = $pdo->prepare($sql);
        $sentencia->execute(array($nueva_contra,$id_persona));

        $_SESSION['password'] = $nueva_contra;
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
    <form action="inicio_artista.php">
            <p id="par">
                <button type="submit" class="btn btn-dark float-right mr-3 ml-3">Inicio</button>
            </p>
        </form>
        <h1>Poyofy Editar Usuario</h1>
        <p style="font-size:17px; color: white;"> Hola <?php echo $_SESSION['usuario'];?>!</p>
    </div>
    <div class="center">
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Ingrese una nueva contraseña:</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" name="nueva_contra">
            </div>         
            <button type="submit" class="btn btn-dark mt-3">Actualizar</button>   
        </form>
    </div>    
</body>
</html>
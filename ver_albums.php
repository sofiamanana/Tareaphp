<?php
    include_once "conexion.php";
    session_start();

    $sql = "SELECT * FROM personas WHERE Usuario = ?;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($_SESSION['usuario']));
    $sen = $sentencia->fetchAll();

    $id_persona = $sen[0]['ID_PERSONA'];

    $sql = "SELECT * FROM Usuarios WHERE ID_PERSONA = ?;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($id_persona));
    $sen = $sentencia->fetchAll();

    $id_usuario = $sen[0]['ID_Usuario'];

    $sql = "SELECT * FROM Canciones;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $canciones = $sentencia->fetchAll();



    
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
            <form action="inicio.php">
                <p id="par">
                    <button type="submit" class="btn btn-dark float-right ml-3">Inicio</button>
                </p>
            </form>
        </form>
            <h1>POYOFY</h1>
            <p style="font-size:17px; color: white;"> Hola <?php echo $_SESSION['usuario'];?>!</p>
        </div>
        <div>           
            <h3 style="color:white; text-align:left;" class="mt-3 ml-3">Canciones:</h3>
        </div>
        <div>
            <div class="form-group">
                <?php foreach($canciones as $can):   
                    $sql = "SELECT * FROM personas WHERE ID_PERSONA = (SELECT ID_PERSONA FROM Artistas WHERE ID_Artista = ?);";
                    $sentencia = $pdo->prepare($sql);
                    $sentencia->execute(array($can['ID_Artista']));
                    $sen = $sentencia->fetchAll();
                    $artista = $sen[0];  ?>
                    <div>
                        <p class="mt-3 ml-3" style="font-size:17px; color:white; text-align:left">* <?php echo $can['Nom_Cancion']; ?> - <?php echo $artista['Nombre']; ?> <?php echo $artista['Apellido']; ?> </p>
                    </div>
                        <?php 
                    endforeach; ?>
            </div>  
        </div>
    </body>
</html>
<?php
    include_once "conexion.php";
    session_start();

    $sql = "SELECT * FROM personas WHERE Usuario = ?;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($_SESSION['usuario']));
    $sen = $sentencia->fetchAll();

    $id_persona = $sen[0]['ID_PERSONA'];

    $sql = "SELECT * FROM Artistas WHERE ID_PERSONA = ?;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($id_persona));
    $sen = $sentencia->fetchAll();
    
    $id_artista = $sen[0]['ID_Artista'];
    
    $sql = "SELECT * FROM Canciones WHERE ID_Artista = ?;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($id_artista));
    $canciones = $sentencia->fetchAll();

    if(isset($_POST['nuevo_nombre'])){
        if(count($_POST)==2){
            $nuevo_nombre = $_POST['nuevo_nombre'];
            foreach($canciones as $can){
                $nom_can = $can['Nom_Cancion'];
                if(isset($_POST[$nom_can])){
                    $sql = "UPDATE `Canciones` SET `Nom_Cancion` = ? WHERE Nom_Cancion = ?;";
                    $sentencia = $pdo->prepare($sql);
                    $sentencia->execute(array($nuevo_nombre,$nom_can));

                }
            }
            header('location:editar_cancion.php');
        }
        else{
            echo "No se pueden editar dos nombres de albums a la vez, seleccione solo uno";
        }      

        
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
                <button type="submit" class="btn btn-dark float-right ml-3">Inicio</button>
            </p>
        </form>
        <h1>Poyofy Editar Cancion</h1>
    </div>
    <div class="center">
        <form method="POST">
            <p>Seleccione una cancion: </p>
            <div class="form-group">
                <?php foreach($canciones as $can): ?>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="<?php echo $can['Nom_Cancion']; ?>">
                        <label class="form-check-label" for="exampleCheck1"><?php echo $can['Nom_Cancion']; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ingrese un nuevo nombre:</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" name="nuevo_nombre">
            </div>         
            <button type="submit" class="btn btn-dark mt-3">Actualizar</button>   
        </form>
    </div>    
</body>
</html>
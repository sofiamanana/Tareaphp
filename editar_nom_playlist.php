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

    $sql = "SELECT ID_Playlist FROM Usuario_Crea WHERE ID_Usuario = ?;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($id_usuario));
    $ids_play = $sentencia->fetchAll();

    if(isset($_POST['nuevo_nombre'])){
        if(count($_POST)==2){
            $nuevo_nombre = $_POST['nuevo_nombre'];
            foreach($ids_play as $id){
                $sql = "SELECT * FROM Playlist WHERE ID_Playlist = ?;";
                $sentencia = $pdo->prepare($sql);
                $sentencia->execute(array($id['ID_Playlist']));
                $sen = $sentencia->fetchAll();

                $nom_playlist = $sen[0]['Nom_Playlist'];
                if(isset($_POST[$nom_playlist])){
                    $sql = "UPDATE `Playlist` SET `Nom_Playlist` = ? WHERE ID_Playlist = ?;";
                    $sentencia = $pdo->prepare($sql);
                    $sentencia->execute(array($nuevo_nombre,$sen[0]['ID_Playlist']));

                }
            }
            header('location:editar_playlist.php');
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
    <form action="inicio.php">
        <p id="par">
            <button type="submit" class="btn btn-dark float-right mt-2 ml-4">Inicio</button>
        </p>
    </form>
    <div id="titleN">
        <h1>Poyofy Editar Playlist</h1>
        <p style="font-size:17px; color: white;"> Hola <?php echo $_SESSION['usuario'];?>!</p>
    </div>
    <div class="center">
        <form method="POST">
            <p>Seleccione playlist: </p>
            <div class="form-group">
                <?php foreach($ids_play as $id): 
                    $sql = "SELECT * FROM Playlist WHERE ID_Playlist = ?;";
                    $sentencia = $pdo->prepare($sql);
                    $sentencia->execute(array($id['ID_Playlist']));
                    $sen = $sentencia->fetchAll();
                    ?>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="<?php echo $sen[0]['Nom_Playlist']; ?>">
                        <label class="form-check-label" for="exampleCheck1"><?php echo $sen[0]['Nom_Playlist']; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ingrese una nuevo nombre:</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" name="nuevo_nombre">
            </div>         
            <button type="submit" class="btn btn-dark mt-3">Actualizar</button>   
        </form>
    </div>    
</body>
</html>
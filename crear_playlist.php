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
    var_dump($_POST);
    if($_POST){
        $nom_playlist = $_POST['nom_playlist'];

        $sql = "SELECT * FROM Playlist WHERE Nom_Playlist = ?;";
        $sentencia = $pdo->prepare($sql);
        $sentencia->execute(array($nom_playlist));
        $sen = $sentencia->fetchAll();

        if(count($sen)==0){
            $sql = "INSERT INTO Playlist (Nom_Playlist) VALUES (?);";
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute(array($nom_playlist));
    
            echo "lalala";
    
            $sql = "SELECT * FROM Playlist WHERE Nom_Playlist = ?;";
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute(array($nom_playlist));
            $sen = $sentencia->fetchAll();
    
            $id_playlist = $sen[0]['ID_Playlist'];
            
            $sql = "INSERT INTO Usuario_Crea (ID_Usuario,ID_Playlist) VALUES (?,?);";
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute(array($id_usuario,$id_playlist));
    
            foreach($canciones as $can){
                $nom_can = $can['Nom_Cancion'];
                if(isset($_POST[$nom_can])){
                    $sql = "SELECT * FROM Canciones WHERE Nom_Cancion = ?;";
                    $sentencia = $pdo->prepare($sql);
                    $sentencia->execute(array($nom_can));
                    $sen = $sentencia->fetchAll();
    
                    $id_cancion = $sen[0]['ID_Cancion'];
    
                    $sql = "INSERT INTO Playlist_Contiene (ID_Playlist,ID_Cancion) VALUES (?,?);";
                    $sentencia = $pdo->prepare($sql);
                    $sentencia->execute(array($id_playlist,$id_cancion));
    
                }
            }
            header('location:inicio.php');
        }
        else{
            echo "Nombre no disponible, intente nuevamente";
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
        <form action="inicio.php">
                <p id="par">
                    <button type="submit" class="btn btn-dark float-right mr-3 ml-3">Inicio</button>
                </p>
            </form>
        <h1>Poyofy Crear Playlist</h1>
    </div>
    <div class="center">
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre Playlist:</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" name="nom_playlist">
            </div>
            <p>Seleccione canciones para agregar: </p>
            <div class="form-group">
                <?php foreach($canciones as $can): ?>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="<?php echo $can['Nom_Cancion']; ?>">
                        <label class="form-check-label" for="exampleCheck1"><?php echo $can['Nom_Cancion']; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>         
            <button type="submit" class="btn btn-dark mt-3">Crear</button>   
        </form>
    </div>    
</body>
</html>
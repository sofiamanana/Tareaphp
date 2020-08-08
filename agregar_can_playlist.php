
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

    $sql = "SELECT * FROM Playlist_Contiene;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $play_contiene = $sentencia->fetchAll();

    $sql = "SELECT * FROM Canciones;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $canciones = $sentencia->fetchAll();

    if($_POST){
        foreach($ids_play as $id){
            $sql = "SELECT * FROM Playlist WHERE ID_Playlist = ?;";
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute(array($id['ID_Playlist']));
            $sen = $sentencia->fetchAll();
            $nom_playlist = $sen[0]['Nom_Playlist'];
            $id_playlist = $id['ID_Playlist'];
            if(isset($_POST[$nom_playlist])){
                break;
            }
        }       
        
        foreach($canciones as $can){
            $nom_cancion = $can['Nom_Cancion'];
            if(isset($_POST[$nom_cancion])){
                
                $sql = "INSERT INTO Playlist_Contiene (ID_Playlist,ID_Cancion) VALUES (?,?);";
                $sentencia = $pdo->prepare($sql);
                $sentencia->execute(array($id_playlist,$can['ID_Cancion']));
            }
        }
        header('location:editar_playlist.php');

    }
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
        <h1>Poyofy Editar Playlist</h1>
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
            <p>Seleccione canciones para agregar: </p>
            <div class="form-group">
                <?php foreach($canciones as $can):     
                    $id_cancion = $can["ID_Cancion"];
                    $sql = "SELECT * FROM Playlist_Contiene WHERE ID_Cancion = ?;";
                    $sentencia = $pdo->prepare($sql);
                    $sentencia->execute(array($id_cancion));
                    $sen = $sentencia->fetchAll();
                    
                    if(count($sen)==0): ?>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="<?php echo $can['Nom_Cancion']; ?>">
                            <label class="form-check-label" for="exampleCheck1"><?php echo $can['Nom_Cancion']; ?></label>
                        </div> 
                    <?php endif;
                endforeach; ?>
            </div>
                    
            <button type="submit" class="btn btn-dark mt-3">Actualizar</button>   
        </form>
    </div>    
</body>
</html>
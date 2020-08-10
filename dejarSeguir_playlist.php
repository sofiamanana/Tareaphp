<?php
    include_once "conexion.php";
    session_start();

    $sql = "SELECT * FROM personas WHERE Usuario = ?;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($_SESSION['usuario']));
    $sen = $sentencia->fetchAll();

    $id_persona = $sen[0]['ID_PERSONA'];

    $sql = "SELECT * FROM Playlist;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $playlist = $sentencia->fetchAll();
    
    if($_POST){     
        foreach($playlist as $play){
            
            if(isset($_POST[$play['ID_Playlist']])){
                var_dump($_POST);
                var_dump($id_persona);
                var_dump($play['ID_Playlist']);
                $sql = "SELECT * FROM Personas_SiguenP WHERE ID_PERSONA = ? AND ID_Playlist = ?;";
                $sentencia = $pdo->prepare($sql);
                $sentencia->execute(array($id_persona,$play['ID_Playlist']));
                $sen = $sentencia->fetchAll();

                $sql = "DELETE FROM Personas_SiguenP WHERE ID_PERSONA = ? AND ID_Playlist = ?;";
                $sentencia = $pdo->prepare($sql);
                $sentencia->execute(array($id_persona,$play['ID_Playlist']));
                unset($_POST);
                header('location:ver_playlistAll.php');
                           
            }
        }
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
        <form action="ver_playlistAll.php">
            <p id="par">
                <button type="submit" class="btn btn-dark float-right ml-3">Inicio</button>
            </p>
        </form>
        <h1>Poyofy Seguir Playlist</h1>
        <p style="font-size:17px; color: white;"> Hola <?php echo $_SESSION['usuario'];?>!</p>
    </div>
    <div class="center">
        <form method="POST">
            <p>Seleccione playlist a seguir: </p>
            <div class="form-group">
                <?php foreach($playlist as $play):  ?>
                    
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="<?php echo $play['ID_Playlist']; ?>">
                            <label class="form-check-label" for="exampleCheck1"><?php echo $play['Nom_Playlist']; ?> </label>
                        </div>
                    <?php 
                endforeach; ?>
            </div>
                    
            <button type="submit" class="btn btn-dark mt-3">Seguir</button>   
        </form>
    </div>    
</body>
</html>
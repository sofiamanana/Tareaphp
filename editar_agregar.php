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
    
    $sql = "SELECT * FROM Albumes WHERE ID_Artista = ?;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($id_artista));
    $albums = $sentencia->fetchAll();

    $sql = "SELECT * FROM Canciones WHERE ID_Artista = ?;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($id_artista));
    $canciones = $sentencia->fetchAll();

    if($_POST){
        foreach($albums as $alb){
            $nom_alb = $alb['Nom_Album'];
            if(isset($_POST[$nom_alb])){
                break;
            }
        }       

        foreach($canciones as $can){

            $sql = "SELECT * FROM Albumes WHERE Nom_Album = ?;";
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute(array($nom_alb));
            $sen = $sentencia->fetchAll();

            $id_album = $sen[0]['ID_Album'];
            $cant_can = $sen[0]['Cant_Canciones'];

            $nom_can = $can['Nom_Cancion'];
            if(isset($_POST[$nom_can])){
                $sql = "UPDATE Canciones SET ID_Album = ? WHERE Nom_Cancion = ?;";
                $sentencia = $pdo->prepare($sql);
                $sentencia->execute(array($id_album,$nom_can));

                $sql = "UPDATE Albumes SET Cant_Canciones = ? WHERE ID_Album = ?;";
                $sentencia = $pdo->prepare($sql);
                $sentencia->execute(array($cant_can+1,$id_album));
                
            }
        }
        unset($_POST);
        header('location:editar_alb.php');
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
        <form action="inicio_artista.php">
            <p id="par">
                <button type="submit" class="btn btn-dark float-right ml-3">Inicio</button>
            </p>
        </form>
        <h1>Poyofy Editar Album</h1>
    </div>
    <div class="center">
        <form method="POST">
            <p>Seleccione album: </p>
            <div class="form-group">
                <?php foreach($albums as $alb): ?>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="<?php echo $alb['Nom_Album']; ?>">
                        <label class="form-check-label" for="exampleCheck1"><?php echo $alb['Nom_Album']; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            <p>Seleccione canciones para agregar: </p>
            <div class="form-group">
                <?php foreach($canciones as $can): 
                    if($can['ID_Album']==NULL):  ?>
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
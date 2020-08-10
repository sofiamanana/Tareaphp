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

    $sql = "SELECT * FROM Canciones;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $canciones = $sentencia->fetchAll();

    if($_POST){
            
        
        foreach($canciones as $can){
            $nom_cancion = $can['Nom_Cancion'];
            if(isset($_POST[$nom_cancion])){

                
                $sql = "DELETE FROM Canciones WHERE ID_Cancion = ?;";
                $sentencia = $pdo->prepare($sql);
                $sentencia->execute(array($can['ID_Cancion']));        
            }
        }
        unset($_POST);
        header('location:editar_cancion.php');
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
        <h1>Poyofy Editar Cancion</h1>
        <p style="font-size:17px; color: white;"> Hola <?php echo $_SESSION['usuario'];?>!</p>
    </div>
    <div class="center">
        <form method="POST">
        <p>Seleccione playlist: </p>
            <p>Seleccione canciones para agregar: </p>
            <div class="form-group">
                <?php foreach($canciones as $can):  
                    if($id_artista==$can['ID_Artista']):   
                    ?>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="<?php echo $can['Nom_Cancion']; ?>">
                            <label class="form-check-label" for="exampleCheck1"><?php echo $can['Nom_Cancion']; ?></label>
                        </div> 
                    <?php endif;
                endforeach; ?>
            </div>     
            <button type="submit" class="butn btn-dark mt-3">Borrar</button>   
        </form>
    </div>    
</body>
</html>
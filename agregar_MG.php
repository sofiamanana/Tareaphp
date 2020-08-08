
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

    

    if($_POST){       
        
        foreach($canciones as $can){
            $nom_cancion = $can['Nom_Cancion'];
            if(isset($_POST[$nom_cancion])){
                
                $sql = "INSERT INTO Usuario_Gusta (ID_Usuario,ID_Cancion) VALUES (?,?);";
                $sentencia = $pdo->prepare($sql);
                $sentencia->execute(array($id_usuario,$can['ID_Cancion']));
            }
        }
        header('location:canciones_MG.php');

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
        <h1>Poyofy Me Gustas</h1>
    </div>
    <div class="center">
        <form method="POST">
            <p>Seleccione canciones para agregar: </p>
            <div class="form-group">
                <?php    
                        $sql = "SELECT * FROM Usuario_Gusta WHERE ID_Usuario = ?;";
                        $sentencia = $pdo->prepare($sql);
                        $sentencia->execute(array($id_usuario));
                        $sen = $sentencia->fetchAll();
                        
                        
                        foreach($canciones as $can): ?>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="<?php echo $can['Nom_Cancion']; ?>">
                                <label class="form-check-label" for="exampleCheck1"><?php echo $can['Nom_Cancion']; ?></label>
                            </div> 
                            <?php                              
                            
                        endforeach; ?> 
            </div>                    
            <button type="submit" class="btn btn-dark mt-3">Me Gusta</button>   
        </form>
    </div>    
</body>
</html>
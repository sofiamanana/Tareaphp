<?php
    include_once "conexion.php";
    session_start();

    $sql = "SELECT * FROM personas WHERE Usuario = ?;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($_SESSION['usuario']));
    $sen = $sentencia->fetchAll();

    $id_persona = $sen[0]['ID_PERSONA'];

    $sql = "SELECT * FROM personas;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $personas = $sentencia->fetchAll();
    
    if($_POST){      
        foreach($personas as $per){
            if(isset($_POST[$per['ID_PERSONA']])){
                $sql = "SELECT * FROM Personas_Siguen WHERE ID_PERSONA = ? AND ID_PERSONA2 = ?;";
                $sentencia = $pdo->prepare($sql);
                $sentencia->execute(array($id_persona,$per['ID_PERSONA']));
                $sen = $sentencia->fetchAll();
                var_dump($sen);

                if(count($sen)!=0){
                    $sql = "DELETE FROM Personas_Siguen WHERE ID_PERSONA = ? AND ID_PERSONA2 = ?;";
                    $sentencia = $pdo->prepare($sql);
                    $sentencia->execute(array($id_persona,$per['ID_PERSONA']));
                    header('location:ver_personasSigo.php');
                }                        
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
        <form action="inicio.php">
            <p id="par">
                <button type="submit" class="btn btn-dark float-right ml-3">Inicio</button>
            </p>
        </form>
        <h1>Poyofy Seguir Personas</h1>
        <p style="font-size:17px; color: white;"> Hola <?php echo $_SESSION['usuario'];?>!</p>
    </div>
    <div class="center">
        <form method="POST">
            <p>Seleccione personas a dejar de seguir: </p>
            <div class="form-group">
                <?php  
                    $sql = "SELECT * FROM Personas_Siguen WHERE ID_PERSONA = ?;";
                    $sentencia = $pdo->prepare($sql);
                    $sentencia->execute(array($id_persona));
                    $sen = $sentencia->fetchAll();

                    foreach($sen as $s): 
                        $sql = "SELECT * FROM personas WHERE ID_PERSONA = ?;";
                        $sentencia = $pdo->prepare($sql);
                        $sentencia->execute(array($s['ID_PERSONA2']));
                        $sen = $sentencia->fetchAll();    ?>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="<?php echo $sen[0]['ID_PERSONA']; ?>">
                            <label class="form-check-label" for="exampleCheck1"><?php echo $sen[0]['Nombre']; ?> <?php echo $sen[0]['Apellido']; ?></label>
                        </div>     

                    <?php endforeach; ?>
            </div>
                    
            <button type="submit" class="btn btn-dark mt-3">Borrar</button>   
        </form>
    </div>    
</body>
</html>
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

                if(count($sen)==0){
                    $sql = "INSERT INTO Personas_Siguen (ID_PERSONA,ID_PERSONA2) VALUES (?,?);";
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
            <p>Seleccione personas a seguir: </p>
            <div class="form-group">
                <?php foreach($personas as $per):  
                    if($id_persona!=$per['ID_PERSONA']):  ?>
                    
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="<?php echo $per['ID_PERSONA']; ?>">
                            <label class="form-check-label" for="exampleCheck1"><?php echo $per['Nombre']; ?> <?php echo $per['Apellido']; ?></label>
                        </div>
                    <?php endif;
                endforeach; ?>
            </div>
                    
            <button type="submit" class="btn btn-dark mt-3">Seguir</button>   
        </form>
    </div>    
</body>
</html>
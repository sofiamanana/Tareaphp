<?php
    include_once "conexion.php";
    session_start();

    if(isset($_POST['nom_can'])){
        $cant_mg = 0;
        $nombre_can = $_POST['nom_can'];
        $a_laz = $_POST['año_lanz'];
        $nom_album = $_POST['nom_alb'];
        
        $sql = "SELECT * FROM Artistas WHERE ID_PERSONA = ?;";
        $sentencia = $pdo->prepare($sql);
        $sentencia->execute(array($_SESSION['id_persona']));
        $sen = $sentencia->fetchAll();
        $id_artista = $sen[0]['ID_Artista'];

        if(($_POST['nom_alb'])==""){
            $sql = "INSERT INTO Canciones (ID_Artista,Cant_MG,Nom_Cancion,A_Lanzamiento) VALUES (?,?,?,?);";
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute(array($id_artista,0, $nombre_can, $a_laz));
            
            header('location:inicio_artista.php');      
        }

        else{
            $sql = "SELECT * FROM Albumes WHERE Nom_Album = ?;";
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute(array($nom_album));
            $sen = $sentencia->fetchAll();

            if(count($sen)==0){
                echo "No existe ese album, intentelo de nuevo";

            }
            else{
                $id_album = $sen[0]['ID_Album'];
                $sql = "INSERT INTO Canciones (ID_Artista,Cant_MG,Nom_Cancion,A_Lanzamiento,ID_Album)
                        VALUES (?,?,?,?,?);";
                $sentencia = $pdo->prepare($sql);
                $sentencia->execute(array($_SESSION['id_persona'],0,$nombre_can,$a_laz,$id_album));
                header('location:agregar_can.php');
                echo "agregada";
            }
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
        <h1>Poyofy agregar canciones</h1>
    </div>
    <div class="center">
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre Canción:</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" name="nom_can">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Año de lanzamiento:</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" name="año_lanz">
            
            </div>
            <div class="form-group div_none">
                <label for="exampleInputEmail1">Nombre Album:</label>
                <p class="text">(Si no pertenece a ningún album, dejar en blanco)</p>
                <input type="text" class="form-control" id="exampleInputEmail1" name="nom_alb">
            </div>         
            <button type="submit" class="btn btn-dark mt-3">Agregar canción</button>   
        </form>
    </div>    
</body>
</html>


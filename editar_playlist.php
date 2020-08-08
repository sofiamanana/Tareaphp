
<?php
    include_once "conexion.php";
    session_start();
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
        <h1>Poyofy Editar Playlist</h1>
        <p style="font-size:17px; color: white;"> Hola <?php echo $_SESSION['usuario'];?>!</p>
       
    </div>
    <div class="center">
        <div>
            <form action="editar_nom_playlist.php">
                <button type="submit" class="btn btn-dark float-center mt-3">Editar Nombre</button>
            </form>  
        </div>
        <div>
            <form action="agregar_can_playlist.php">
                <button type="submit" class="btn btn-dark float-center mt-3">Agregar Canciones</button>
            </form>
        </div>
        <div>
            <form action="borrar_can.php">
                <button type="submit" class="btn btn-dark float-center mt-3">Borrar Canciones</button>
            </form> 
        </div>  
        <div>
            <form action="borrar_playlist.php">
                <button type="submit" class="btn btn-dark float-center mt-3">Borrar Playlist</button>
            </form> 
        </div>              
    </div>    
</body>
</html>
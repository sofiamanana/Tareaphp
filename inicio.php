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
        <form action="index.php">
            <p id="par">
                <button type="submit" class="btn btn-dark float-left ml-3">Log Out</button>
            </p>
        </form>
            <h1>POYOFY</h1>
        </div>
        <div>
            <form action="crear_playlist.php">
                <button type="submit" class="btn btn-success float-left mt-3 ml-3">Crear Playlist</button>
            </form>
            <form action="editar_playlist.php">
                <button type="submit" class="btn btn-success float-left mt-3 ml-3">Editar Playlist</button>
            </form>
            
        </div>
    </body>
</html>
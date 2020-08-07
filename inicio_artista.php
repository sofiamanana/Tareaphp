<?php
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
                    <button type="submit" class="btn btn-dark float-right ml-3">Log Out</button>
                </p>
            </form>
            <p>
                <h1>POYOFY</h1>           
            
                <p style="font-size:17px; color: white;"> Hola <?php echo $_SESSION['usuario'];?>!</p>
                <form action="editar_cuenta.php">
                    <button type="submit" class="btn btn-success float-right mt-3">Configuración</button>
                </form>
        </p>
        </div>
        <div>
            <form action="agregar_can.php">
                <button type="submit" class="btn btn-success mt-3 ml-3 float-left">Agregar Canciones</button>
            </form>
            <form action="agregar_alb.php">
                <button type="submit" class="btn btn-success mt-3 ml-3 float-left">Agregar Album</button>
            </form>
            <form action="editar_alb.php">
                <button type="submit" class="btn btn-success mt-3 ml-3 float-left">Editar Album</button>
            </form>
            <form action="editar_cancion.php">
                <button type="submit" class="btn btn-success mt-3 ml-3 float-left">Editar Canciones</button>
            </form>
        </div>
    </body>
</html>
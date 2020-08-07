
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
        <form action="inicio_artista.php">
                <p id="par">
                    <button type="submit" class="btn btn-dark float-right ml-3">Inicio</button>
                </p>
            </form>
        <h1>Poyofy Editar Cuenta</h1>
        <p style="font-size:17px; color: white;"> Hola <?php echo $_SESSION['usuario'];?>!</p>
    </div>
    <div class="center">
        <div>
            <form action="editar_usuario.php">
                <button type="submit" class="btn btn-dark float-center mt-3">Editar usuario</button>
            </form>  
        </div>
        <div>
            <form action="editar_contra.php">
                <button type="submit" class="btn btn-dark float-center mt-3">Editar contraseña</button>
            </form>
        </div>
        <div>
            <form action="editar_nombre.php">
                <button type="submit" class="btn btn-dark float-center mt-3">Editar nombre</button>
            </form> 
        </div>
        <div>
            <form action="editar_apellido.php">
                <button type="submit" class="btn btn-dark float-center mt-3">Editar apellido</button>
            </form> 
        </div>
        <div>
            <form action="editar_mail.php">
                <button type="submit" class="btn btn-dark float-center mt-3">Editar mail</button>
            </form> 
        </div>       
        <div>
            <form action="borrar_cuenta.php">
                <button type="submit" class="btn btn-dark float-center mt-3">Borrar Cuenta</button>
            </form> 
        </div>   
    </div>    
</body>
</html>
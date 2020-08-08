<?php

    include_once 'conexion.php';
    session_start();

    if($_POST){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $_SESSION['usuario'] = $usuario;
        $_SESSION['password'] = $password;

        //casos: usuario no existe, contraseña no calza con el usuario

        $sql = "SELECT * FROM personas WHERE Usuario = ?;";
        $sentencia = $pdo->prepare($sql);
        $sentencia->execute(array($usuario));
        $sen = $sentencia->fetchAll();                       
                        
        
       
        if(count($sen)==0){
            echo "Usuario incorrecto";
            
        }
        else{

            $id_persona = $sen[0]["ID_PERSONA"];
            
            $sql = "SELECT * FROM personas WHERE Usuario = ? AND Password = ?;";
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute(array($usuario,$password));
            $sen = $sentencia->fetchAll();

            if(count($sen)==0){
                echo "Contraseña incorrecta";
            }
            else{
                $sql = "SELECT * FROM Artistas WHERE ID_PERSONA = ?;";
                $sentencia = $pdo->prepare($sql);
                $sentencia->execute(array($id_persona));
                $sen = $sentencia->fetchAll();

                if(count($sen)==0){
                    header('location:inicio.php');
                }
                else{
                    header('location:inicio_artista.php');
                }
                
            }            
        }
          
    }
    unset($_POST);  
?>                 

<html>
    <head>
      <title>Poyofy</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="stylesheet" href="style.css">
      <link rel="shortcut icon" href="kirby.png" />
    </head>
    <body>
        <div id="title">
            <h1>POYOFY</h1>
        </div>
        <div class="center">
            <form action="nueva_cuenta.php">
                <p>¿No tienes una cuenta? <input class="btn btn-dark mt-3" type="submit" value="¡Registrate aqui!" /></p>
            </form>
            <form method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Usuario</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="usuario">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" class="form-control mt-3" id="exampleInputPassword1" name="password">
                </div>
                <button type="submit" class="btn btn-dark mt-3">Iniciar Sesión</button>
            </form>
        </div>
    </body>
</html> 
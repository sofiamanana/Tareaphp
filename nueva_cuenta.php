<?php
    session_start();
    include_once 'conexion.php';

    if($_POST){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $mail = $_POST['mail'];

        $_SESSION['usuario'] = $usuario;
        $_SESSION['password'] = $password;
               
        if($usuario==""){
            echo "Necesita llenar el campo de usuario";
        }
        elseif($password==""){
            echo "Necesita llenar el campo de contraseña";
        }
        elseif($nombre==""){
            echo "Necesita poner un nombre";
        }
        else{
                $sql = "SELECT * FROM personas WHERE Usuario = ?;";
                $sentencia = $pdo->prepare($sql);
                $sentencia->execute(array($usuario));
                $sen = $sentencia->fetchAll();

                if(count($sen)==0){
                    $sql = "INSERT INTO personas (Usuario,Password,Nombre,Apellido,Mail) VALUES (?,?,?,?,?);";
                    $sentencia = $pdo->prepare($sql);
                    $sentencia->execute(array($usuario,$password,$nombre,$apellido,$mail));
                    
                    if(isset($_POST['artista'])){
                        $artista = $_POST['artista'];
                        //ENCONTRAR EL ID PERSONA
                        $sql = "SELECT * FROM personas WHERE Usuario = ?;";
                        $sentencia = $pdo->prepare($sql);
                        $sentencia->execute(array($usuario));
                        $sen = $sentencia->fetchAll();                       
                        
                        $id_persona = $sen[0]["ID_PERSONA"];
                        $_SESSION['id_persona'] = $id_persona;
                        //AGREGAR A ARTISTAS
                        $sql = "INSERT INTO Artistas (ID_PERSONA) VALUES (?);";
                        $sentencia = $pdo->prepare($sql);
                        $sentencia->execute(array($id_persona));

                        $sql = "SELECT * FROM Artista WHERE Usuario = ?;";
                        $sentencia = $pdo->prepare($sql);
                        $sentencia->execute(array($usuario));
                        $sen = $sentencia->fetchAll();

                        if(count($sen)!=0){
                            $_SESSION['id_artista'] = $sen[0]['ID_Artista'];
                        }

                        header('location:inicio_artista.php');

                    } 
                    else{

                        $sql = "SELECT * FROM personas WHERE Usuario = ?;";
                        $sentencia = $pdo->prepare($sql);
                        $sentencia->execute(array($usuario));
                        $sen = $sentencia->fetchAll();                       
                        
                        $id_persona = $sen[0]["ID_PERSONA"];
                        
                        $sql = "INSERT INTO Usuarios (ID_PERSONA) VALUES (?);";
                        $sentencia = $pdo->prepare($sql);
                        $sentencia->execute(array($id_persona));

                        header('location:inicio.php');
                    }

                    
                }
                else{
                    echo "Nombre de usuario no disponible, trate nuevamente";
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
            <h1>POYOFY</h1>
        </div>
        <div class="center">
            <form method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Usuario</label>
                        <input type="text" class="form-control" name="usuario">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Nombre</label>
                    <input type="text" class="form-control" name="nombre">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Apellido</label>
                    <input type="text" class="form-control" name="apellido">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Email</label>
                    <input type="text" class="form-control" name="mail">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" value="0" name="artista">
                    <label class="form-check-label" for="exampleCheck1">Artista</label>
                </div>
                <button class="btn btn-dark mt-3">Crear cuenta</button>
            </form>
        </div>
    </body>
</html>
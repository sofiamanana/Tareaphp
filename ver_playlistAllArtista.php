
<?php
    include_once "conexion.php";
    session_start();

    $sql = "SELECT * FROM personas WHERE Usuario = ?;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($_SESSION['usuario']));
    $sen = $sentencia->fetchAll();

    $id_persona = $sen[0]['ID_PERSONA'];

    $sql = "SELECT ID_Playlist FROM Usuario_Crea;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $ids_play = $sentencia->fetchAll();

    $sql = "SELECT * FROM Playlist;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $playlist = $sentencia->fetchAll();

    $sql = "SELECT * FROM Playlist_Contiene;";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $play_contiene = $sentencia->fetchAll();
   
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
            <h1>POYOFY</h1>
            <p style="font-size:17px; color: white;"> Hola <?php echo $_SESSION['usuario'];?>!</p>
        </div>
        <table>
            <tr>
                <td style="vertical-align: top; line-height:20px;">
                    <div>
                        <div>             
                            <h3 style="color:white; text-align:left;" class="mt-3 ml-3">Todas las Playlist:</h3>
                        </div>
                        <div class="form-group">
                            <?php foreach($playlist as $play): ?>
                                <div>
                                    <p class="mt-3 ml-3" style="font-size:17px; color:#1DB954; text-align:left">* <?php echo $play['Nom_Playlist']; ?></p>
                                </div>

                                <?php 
                                    $sql = "SELECT * FROM Playlist_Contiene WHERE ID_Playlist = ?;";
                                    $sentencia = $pdo->prepare($sql);
                                    $sentencia->execute(array($play['ID_Playlist']));
                                    $play_contiene = $sentencia->fetchAll();

                                    foreach($play_contiene as $c):
                                        $sql = "SELECT * FROM Canciones WHERE ID_Cancion = ?;";
                                        $sentencia = $pdo->prepare($sql);
                                        $sentencia->execute(array($c['ID_Cancion']));
                                        $can = $sentencia->fetchAll();

                                        $sql = "SELECT * FROM personas WHERE ID_PERSONA = (SELECT ID_PERSONA FROM Artistas WHERE ID_Artista = ?);";
                                        $sentencia = $pdo->prepare($sql);
                                        $sentencia->execute(array($can[0]['ID_Artista']));
                                        $sen = $sentencia->fetchAll();
                                        $artista = $sen[0]; ?>


                                        <div>
                                            <p class="mt-3 ml-3" style="font-size:17px; color:white; text-align:left">   - <?php echo $can[0]['Nom_Cancion']; ?> - <?php echo $artista['Nombre'];?> <?php echo $artista['Apellido'];?></p>
                                        </div>                            
                            
                                <?php endforeach;
                            endforeach; ?>
                        </div>  
                    </div> 
                </td>
                <td style="vertical-align: top; line-height:20px;">
                    <div>
                        <div>       
                            <h3 style="color:white; text-align:left;" class="mt-3 ml-3">Playlist que Sigo:</h3>
                        </div>
                        <div class="form-group">
                            <?php 
                                $sql = "SELECT * FROM Personas_SiguenP WHERE ID_PERSONA = ?;";
                                $sentencia = $pdo->prepare($sql);
                                $sentencia->execute(array($id_persona));
                                $sen = $sentencia->fetchAll();

                                foreach($sen as $s):
                                    $sql = "SELECT * FROM Playlist WHERE ID_Playlist = ?;";
                                    $sentencia = $pdo->prepare($sql);
                                    $sentencia->execute(array($s['ID_Playlist']));
                                    $p = $sentencia->fetchAll();

                                    $sql = "SELECT * FROM Playlist_Contiene WHERE ID_Playlist = ?;";
                                    $sentencia = $pdo->prepare($sql);
                                    $sentencia->execute(array($s['ID_Playlist']));
                                    $play_contiene = $sentencia->fetchAll(); ?>

                                    <div>
                                        <p class="mt-3 ml-3" style="font-size:17px; color:#1DB954; text-align:left">* <?php echo $p[0]['Nom_Playlist']; ?> </p>
                                    </div>

                                    <?php foreach($play_contiene as $play):
                                        $sql = "SELECT * FROM Canciones WHERE ID_Cancion = ?;";
                                        $sentencia = $pdo->prepare($sql);
                                        $sentencia->execute(array($play['ID_Cancion']));
                                        $can = $sentencia->fetchAll();

                                        $sql = "SELECT * FROM personas WHERE ID_PERSONA = (SELECT ID_PERSONA FROM Artistas WHERE ID_Artista = ?);";
                                        $sentencia = $pdo->prepare($sql);
                                        $sentencia->execute(array($can[0]['ID_Artista']));
                                        $sen = $sentencia->fetchAll();
                                        $artista = $sen[0];
                                    ?>
                                    <div>
                                        <p class="mt-3 ml-3" style="font-size:17px; color:white; text-align:left">   - <?php echo $can[0]['Nom_Cancion']; ?> - <?php echo $artista['Nombre'];?> <?php echo $artista['Apellido'];?></p>
                                    </div>
                                <?php endforeach;
                            endforeach; ?>
                        </div>  
                    </div> 
                </td>
                <td style="vertical-align: top; line-height:20px;">
                    <div>
                        <form action="seguir_playlist.php">
                            <button type="submit" class="btn btn-success float-right mt-3 ml-3">Seguir Playlist</button>
                        </form> 
                        <form action="dejarSeguir_playlist.php">
                            <button type="submit" class="btn btn-success float-right mt-3 ml-3">Dejar de Seguir Playlist</button>
                        </form> 
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>

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
        <h1>Poyofy Editar Album</h1>
    </div>
    <div class="center">
        <form method="POST">
            <p>Seleccione album: </p>
            <div class="form-group">
                <?php foreach($albums as $alb): ?>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="<?php echo $alb['Nom_Album']; ?>">
                        <label class="form-check-label" for="exampleCheck1"><?php echo $alb['Nom_Album']; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            <p>Seleccione canciones para agregar: </p>
            <div class="form-group">
                <?php foreach($canciones as $can): 
                    if($can['ID_Album']==NULL):  ?>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="<?php echo $can['Nom_Cancion']; ?>">
                            <label class="form-check-label" for="exampleCheck1"><?php echo $can['Nom_Cancion']; ?></label>
                        </div>
                    <?php endif;
                endforeach; ?>
            </div>
                    
            <button type="submit" class="butn btn-primary mt-3">Actualizar</button>   
        </form>
    </div>    
</body>
</html>
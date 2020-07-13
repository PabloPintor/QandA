<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir preguntas</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</head>
<body>
    
    <div class="container">
    <div class="row">
            <div class="mt-3 col-12 col-md-6">
            
            <h1>Añadir preguntas al juego</h1>
            <p>Las preguntas deben ir una por cada línea</p>

                <form action="añadir.php" method="post">
                    <select class="form-control" name="fichero">
                        <option value="preguntas">Añadir preguntas normales</option>
                        <option value="probable">Añadir preguntas "quien es mas probable..." </option>
                    </select>

                    <br/>

                    <textarea class="form-control" name="texto" cols="30" rows="10" required></textarea>

                    <br/>

                    <input class="btn btn-primary" type="submit" name="boton" value="Enviar">
                    <a class="btn btn-warning" href="index.php">Volver</a>

                </form>


                <?php

                function añadirContenido($nombreFichero){
                    //obtener preguntas
                    $preguntas = $_POST['texto'];
                    //obtener contenido antiguo del fichero y concatenar al contenido nuevo
                    $contenido = file_get_contents($nombreFichero);
                    $contenido .= $preguntas."\n";
                    file_put_contents("$nombreFichero", "$contenido");
                    header("Location:index.php");
                }

                if (isset($_POST['boton'])){

                    //obtener sobre que fichero trabajamos
                    if ($_POST['fichero'] == "preguntas"){
                        $nombreFichero = "preguntas.txt";
                        añadirContenido($nombreFichero);
                    }
                    else if($_POST['fichero'] == "probable"){
                        $nombreFichero = "probable.txt";
                        añadirContenido($nombreFichero);
                    }
                    else{
                        echo "<h1>Error en la seleccion del fichero</h1>";
                    }

                }

                ?>

            </div>
        </div>
    </div>

</body>
</html>



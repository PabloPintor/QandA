<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pregunta aleatoria</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</head>
<body>
    
    <div class="container">
    <div class="row">
            <div class="mt-3 col-12 col-md-6">

            <br/>

            <?php
            //abrir y leer fichero dependiendo del boton
            if (!isset($_POST['boton'])){
                echo "<h1>Elige una de las opciones para jugar</h1>";
            }
            else{

                if ($_POST['boton'] == "pregunta"){
                    $nombreFichero = "preguntas.txt";
                }
                else if($_POST['boton'] == "probable"){
                    $nombreFichero = "probable.txt";
                }

                $fichero = fopen($nombreFichero, "r");
                
                if ( 0 == filesize($nombreFichero) ){
                    echo "<h1>Hay que añadir preguntas</h1>";
                }
                else{
                    while (!feof($fichero)) {
                        $vector=fgets($fichero,1024);
                        $array_preguntas [] = $vector;
                    }
                    fclose($fichero);
                    
                    //elegir pregunta y mostrarla
                    do{
                        $numero = rand(0, sizeOf($array_preguntas)-1);
                    }
                    while ($array_preguntas[$numero] == "");
                    
                    echo "<h1>Pregunta: ".$array_preguntas[$numero]."</h1>";
                    
                    //eliminar pregunta
                    $fichero_salida = file($nombreFichero); // Read the whole file into an array
                    unset($fichero_salida[$numero]);
                    file_put_contents("$nombreFichero", implode("", $fichero_salida));
                }
                
            }

            ?>

                <form action='index.php' method='post'>

                        <button class="mt-1 btn btn-primary" name='boton' type='submit' value='pregunta'>Pregunta aleatoria</button>
                        <button class="mt-1 btn btn-primary" name='boton' type='submit' value='probable'>¿Quien es mas probable que...?</button>
                        <a class="mt-1 btn btn-warning" href="añadir.php">Añadir preguntas</a>
                        
                </form>



            </div>
        </div>
    </div>

</body>
</html>
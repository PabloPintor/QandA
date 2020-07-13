<?php
//mostrar formulario
echo "<form action='index.php' method='post'>

        <button type='submit'>Pregunta aleatoria</button>

    </form>";

//abrir y leer fichero
$nombreFichero = "preguntas.txt";
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

?>
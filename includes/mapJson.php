<?php
require_once('toolkit.php');
$map = new map;
$user = new Users;

//Datos 
$data = array();

$data['config'] = [
	'apiKey' => c::get('google.apiKey'),
	'lat' => c::get('map.lat'),
	'lng' => c::get('map.lng'),
	'zoom' => c::get('map.zoom'),
	];

//Categorías
$data['cats'] = $map->getCats();

//MARCAS
//Si el usuario está logedo, obtenemos su configuración, si no mostramos la de por defecto
$marks_config = array();

if($user->logged){ 
   $marks_config = $user->user_data['marks_config'];
}
else
{
	$marks_config = c::get('marks.config');
}

$data['marks_config'] = $marks_config;

//Obtenemos las marcas
$data['marks'] = $map->getMarks($marks_config);

header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT); //Muestra el archivo JSON formateado bonito
//echo json_encode($data);

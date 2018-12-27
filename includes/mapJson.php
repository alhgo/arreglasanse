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

//Si se ha especificado el orden
if(isset($_GET['order']) && $_GET['order'] != '') $marks_config['order'] = $_GET['order'];
//Si se ha especificado el tipo de orden
if(isset($_GET['order_type']) && $_GET['order_type'] != '') $marks_config['order_type'] = $_GET['order_type'];
//Si se ha especificado una búsqueda
$search = (isset($_GET['search']) && $_GET['search'] != '') ? $_GET['search'] : '';


$data['marks_config'] = $marks_config;

//Obtenemos las marcas
$data['marks'] = $map->getMarks($marks_config,$search);

//Añadimos las palabras clave
$data['tags'] = $map->tags;

header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT); //Muestra el archivo JSON formateado bonito
//echo json_encode($data);

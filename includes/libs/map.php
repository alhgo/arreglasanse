<?php
/*GOOGLE MAPS CLASSES */
class Map
{
	
	private $db;
	
	function __construct()
	{
		//Conectamos con la base de datos
		$this->db = new MysqliDb (Array (
                'host' => c::get('db.host'),
                'username' => c::get('db.username'), 
                'password' => c::get('db.password'),
                'db'=> c::get('db.database'),
                'port' => 3306,
                'prefix' => '',
                'charset' => 'utf8'));	
	}
	
	function __destruct(){
		$this->db->disconnect();
	}
	
	public function getCats()
	{
		$result = array();
		$db = $this->db;
		$db->orderBy("ord","asc");
		$cats = $db->get ("marks_cat");
		if ($db->count > 0)
			foreach ($cats as $cat) 
			{ 
				$result[] = ['id_cat' => $cat['id_cat'], 'order' => $cat['ord'], 'name' => $cat['name'], 'icon' => $cat['icon']];
			}
		return $result;
	}
	
	public function getMarks($marks_config,$search='')
	{
		/* ---- Opciones de configuración de las marcas -------
		- Order
		- Order_type
		*/
		
		//Obtenemos los datos de las categorías
		$cats = $this->getCats();
		//Iconos
		$icons = array();
		foreach($cats AS $cat)
		{
			$icons[$cat['id_cat']] = [
				'icon' => $cat['icon'],
				'dim' => 'd-' . $cat['icon'],
				'solved' => 's-' . $cat['icon']
			];
			
		}
		
		/* ---- Antiguedad de la marca -------
		0: 1 semana
		1: 1 mes
		2: 3 meses
		3: 6 meses
		4: 1 año
		5: más antigua
		*/
		$a = [time() - 604800, time() - 2419200, time() - 7257600, time() - 14515200, time() - 29030400];
		
		//Creamos el array con las marcas
		$result = array();
		$db = $this->db;
		$db->orderBy($marks_config['order'],$marks_config['order_type']);
		$marks = $db->get ("marks");
		if ($db->count > 0)
			foreach ($marks as $mark) 
			{ 
				//Icono dependiendo de si está resuelta o no
				$icon = ($mark['time_solved'] != '' ? $icons[$mark['id_cat']]['solved'] : $icons[$mark['id_cat']]['icon']);
				
				switch (true){
					case $mark['time_updated'] < $a[4]:
						$ant = 5;
						break;
					case $mark['time_updated'] < $a[3]:
						$ant = 4;
						break;
					case $mark['time_updated'] < $a[2]:
						$ant = 3;
						break;
					case $mark['time_updated'] < $a[1]:
						$ant = 2;
						break;
					case $mark['time_updated'] < $a[0]:
						$ant = 1;
						break;
					default:
						$ant = 0;
				}
				
				//Decidimos si está oculta o no, en base a la configuración de las marcas
				$hidden = false;
				if(isset($marks_config['hide']) && is_array($marks_config['hide']))
				{
					$array_hidden = $marks_config['hide'];
				}
				else
				{
					$array_hidden = array();
				}
				if(in_array($mark['id_cat'],$array_hidden)) //Está entre las categorías ocultas
				{
					$hidden = true;
				}
				else if($ant > $marks_config['ant']) //La antiguedad es mayor 
				{
					$hidden = true;
				}
				else if($mark['time_solved'] != NULL && $marks_config['solved'] == 'hide') //Si está resuelta y se ha pedido ocultar las resueltas
				{
					$hidden = true;
				}
				
				//Si no tiene imagen asignada, la ponemos genérica
				if($mark['image'] != null && $mark['image'] != '')
				{
					//Comprobamos que la imagen existe y tiene un thumbnail
					
					$image = $mark['image'];
				}
				else
				{
					$image = 'default.jpg';
				}
				
				$result[] = [
					'id_mark' => $mark['id_mark'], 
					'id_cat' => $mark['id_cat'], 
					'lat' => $mark['lat'], 
					'lng' => $mark['lng'], 
					'tit' => $mark['tit'], 
					'descr' => $mark['descr'], 
					'image' => $image, 
					'icon' => $icon,
					'updated' => $mark['time_updated'],
					'time_solved' => $mark['time_solved'],
					'ant' => $ant,
					'agree' => $ant,
					'ant' => $mark['agree'],
					'comments' => $mark['comments'],
					'hidden' => $hidden
				];
			}
		return $result;
	}
}

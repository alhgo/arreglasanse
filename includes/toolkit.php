<?php
/**
 * TOOLKIT 
 *
 * Herramientas básicas del sitio
 *
 * @package   ArreglaSanse Toolkit
 * @author    Álvaro Holguera <correo@laultimapregunta.com>
 * @link      http://laultimapregunta.com
 * @copyright Álvaro Holguera
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

/* LIBS */

//PHP Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


//Cargamos TODAS las librerías PHP de la carpeta libs
//Si queremos que una librería se ignore, basta con ponerle un guion bajo al comienzo del nombre
function getDirContents($dir, &$results = array()){
    $files = scandir(__DIR__ . "/" . $dir);

    foreach($files as $key => $value){
        //$path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        $path = $dir.'/'.$value;
        if(!is_dir($path) && substr($value,0,1) != '_') {
            $results[] = $path;
        } else if($value != "." && $value != "..") {
            //Obtener subdirectorios
			//getDirContents($path, $results);
            //$results[] = $path;
        }
    }
	//print_r($results);
    return $results;
}

$libs = getDirContents('libs');
foreach($libs AS $key=>$value)
{
	if(substr($value,-3) == 'php' && substr($value, 6, 1) != '_')
	{
		//require_once($value);	
		$root = dirname(__FILE__).'/' . $value;
		require_once($root);	
		//echo  $value . "<br>";
	}
	
}



/*CONFIG*/
require_once(dirname(__FILE__).'/config.php');

//Si existe un archivo de configuración específico para el dominio, lo cargamos
if(file_exists(dirname(__FILE__).'/config.'.$_SERVER['SERVER_NAME'].'.php'))
{
	require_once(dirname(__FILE__).'/config.'.$_SERVER['SERVER_NAME'].'.php');
	
}

/*TEST MYSQL*/
if(!$db = new MysqliDb (Array (
		'host' => c::get('db.host'),
		'username' => c::get('db.username'), 
		'password' => c::get('db.password'),
		'db'=> c::get('db.database'),
		'port' => 3306,
		'prefix' => '',
		'charset' => 'utf8'))
   )
{
	die('Se ha producido un problema al conectar con la base de datos');
}
else{
	$db->disconnect();
}

$site = new Site;




?>

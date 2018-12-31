<?php

require_once('includes/toolkit.php');

$error = (isset($_GET['error'])) ? $_GET['error'] : 'default';
$errorAdd = (isset($_GET['add'])) ? $_GET['add'] : '';

//Errores
$errorArray = array(
	'default' => array(
		'title' => 'Se ha producido un error',
		'text' => 'La página no está funcionando. Por favor, póngase en contacto con el administrador si el sistema persiste.'),
	'FirebaseUserAuth' => array(
		'title' => 'Error en la Base de Datos',
		'text' => 'Se ha producido un error al autenticarse en la Base de Datos Firebase.'),
);

?>

<?php snippet('header.php',['title'=>'Página de error']); ?>

<body>
	

<?php snippet('nav.php',['active' => 'home']); ?>

	<div class="container-fluid p-0 m-0">
		
		<?php //snippet('breadcrumb.php',array('data' => ['Inicio' => 'index.php'])); ?>
		
		<?php snippet('error.php',['error' => $error, 'add' => $errorAdd]); ?>

	</div>
<?php snippet('footer.php', ['libs' => array('forms.js','map.js')]); ?>

</body>
</html>
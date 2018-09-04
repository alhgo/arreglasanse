<?php

require_once('includes/toolkit.php');

//Obtenemos los datos del usuario
$user = new users;

//Si no es administrador, lo mandamos a logeo
if(!$user->is_admin) url::go('index.php');
?>

<?php //snippet('header.php',['title'=>$site->title]); ?>

<body>
ADMIN
<?php //snippet('nav.php',['active' => 'home']); ?>

	<div class="container">
		
		<?php //snippet('breadcrumb.php',array('data' => ['Inicio' => 'index.php'])); ?>
		
		<?php //snippet('map.php'); ?>

		<?php //snippet('footer.php'); ?>

	</div>
</body>
</html>
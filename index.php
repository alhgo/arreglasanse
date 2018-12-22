<?php

require_once('includes/toolkit.php');

//Obtenemos los datos del usuario
$user = new users;

?>

<?php snippet('header.php',['user' => $user, 'title'=>$site->title]); ?>

<body>
	

<?php snippet('nav.php',['active' => 'home']); ?>

	<div class="container-fluid p-0 m-0">
		
		<?php //snippet('breadcrumb.php',array('data' => ['Inicio' => 'index.php'])); ?>
		
		<?php snippet('map.php',['user' => $user]); ?>

		<?php if(!$user->logged) snippet('login_form_modal.php'); ?>

	</div>
<?php snippet('footer.php', ['libs' => array('forms.js','map.js')]); ?>

</body>
</html>
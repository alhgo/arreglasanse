<?php
require_once('includes/toolkit.php');

$action = (isset($_GET['action'])) ? $_GET['action'] : '';

//Obtenemos los datos del usuario
$user = new users;

//Breadcrumb array
switch($action) {
	case 'register':
	case 'registerUser':
	case 'confirmUser':
		$bc_array = ['Inicio' => 'index.php', 'Usuarios' => 'user.php', 'Registro' => ''];
		break;
	case 'loginUser':
		$bc_array = ['Inicio' => 'index.php', 'Usuarios' => 'user.php', 'Login' => ''];
		break;
	case 'rememberPass':
		$bc_array = ['Inicio' => 'index.php', 'Usuarios' => 'user.php', 'Recordar Contraseña' => ''];
		break;
	default:
		$bc_array = ['Inicio' => 'index.php', 'Usuario' => 'user.php'];
	
}

?>

<?php snippet('header.php',['title'=>$site->title]); ?>

<body>
	<!-- Page Content -->
    
<?php snippet('nav.php',['active' => 'home']); ?>
	
	<div class="container">
		
		<?php snippet('breadcrumb.php',array('data' => $bc_array)); ?>
<?php 

	if($action == 'register')
	{
		snippet('user_register_form.php');
	}
	else if($action == 'registerUser')
	{
		snippet('user_register.php', array('user'=>$user));
	}
	else if($action == 'confirmUser')
	{
		snippet('user_confirm.php', array('user'=>$user));
	}
	else if($action == 'loginUser')
	{
		snippet('login_form.php', array('user'=>$user));
	}
	else if($action == 'rememberPass')
	{
		snippet('user_remember.php');
	}
	else
	{
		snippet('user_data.php', array('user' => $user));
	}

 ?>
	</div>

<?php if(!$user->logged && $action != 'loginUser') snippet('login_form_modal.php'); ?>

<?php snippet('footer.php', ['libs' => array('forms.js')]); ?>
	
</body>
</html>
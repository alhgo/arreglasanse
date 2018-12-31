<?php
require_once('includes/toolkit.php');

//Obtenemos los datos del sitio y del usuario
$user = new Users;
$site = new Site;

$user->destroyCookie();

?>

<?php snippet('header.php',['user' => $user, 'title'=>$site->title]); ?>


<?php snippet('footer.php', ['libs' => array()]); ?>

<script>
//$(document).ready( function() {	
	firebase.auth().signOut().then(function() {
  		// Sign-out successful.
		console.log('Signed Out');
		//Redirigimos
		window.location.href = '<?= c::get('site.url') ?>';
		}).catch(function(error) {
  		// An error happened.
	  	console.error('Sign Out Error', error);
	});
//});

</script>

	
<?php	


//url::go('user.php');


?>


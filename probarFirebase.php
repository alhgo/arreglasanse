<?php

require_once('includes/toolkit.php');

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

if(is_file(__DIR__.'/includes/' . c::get('fb.jsonFile')))
{
   $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/includes/' . c::get('fb.jsonFile'));
	
}
else
{
	die('Error al conectar por PHP');
	//url::go('error.php');
}
	

//Obtenemos los datos del usuario
$user = new users;
//echo $user->user_data['custom_token'];

//Creamos un token
/*
$firebase = (new Factory)
			->withServiceAccount($serviceAccount)
			->withDatabaseUri(c::get('fb.url'))
			->create();

//OBtenemos un Token válido para autenticarse a partir del ID generado en firebase
$customToken = $firebase->getAuth()->createCustomToken($uid);
*/
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Probar Firebase</title>
	<!--Firebase-->
	<script src="https://www.gstatic.com/firebasejs/5.4.0/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/5.4.0/firebase-auth.js"></script>
	<script src="https://www.gstatic.com/firebasejs/5.4.0/firebase-database.js"></script>
	<script>
	  // Initialize Firebase
	  var config = {
		apiKey: "<?= c::get('fb.apiKey') ?>",
		authDomain: "<?= c::get('fb.authDomain') ?>",
		databaseURL: "<?= c::get('fb.databaseURL') ?>",
		projectId: "<?= c::get('fb.projectId') ?>",
		storageBucket: "<?= c::get('fb.storageBucket') ?>",
		messagingSenderId: "<?= c::get('fb.messagingSenderId') ?>"
	  };
	  firebase.initializeApp(config);
		console.log('Firebase inicializado');
	  <?php if($user->logged) : ?> 	
	  //Auth 
	  firebase.auth().signInWithCustomToken('<?= $user->user_data['custom_token'] ?>').catch(function(error) {
	  // Handle Errors here.
	  var errorCode = error.code;
	  var errorMessage = error.message;
	  if(error)
	  {
		  alert(errorCode);
		  //window.location.href = '<?= c::get('site.url') ?>/error.php?error=FirebaseUserLogin&add=errorCode:' + errorCode;
	  }
	  // ...
	});
		
	
	
	<?php endif ?>
	</script>
	
	
	<script>
	//Comprobamos que el usuario está logeado
	firebase.auth().onAuthStateChanged(function(user) {
	  if (user) {
		// User is signed in.
		console.log('logeado en firebase');
		//Añadimos el apunte a su base de datos
		var user = firebase.auth().currentUser;
		if (user != null) {
			uid = user.uid; 
			firebase.database().ref('users/' + uid + '/lastLogin').set(<?= time() ?>);
		}  
		
	  } else {
		alert('Se ha producido un error al logear el usuario en la base de datos.')
		
	  }
	  // ...
	});
	
	
	</script>
	
	
</head>

<body>
</body>
</html>
<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>
    
    <link rel="icon" href="images/web-icon.jpg" type="image/x-icon" >
	<link rel="shortcut icon" href="images/web-icon.jpg" type="image/x-icon" >

    <!-- Site Stylesheet -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	  
    
    <!-- Custom Fonts -->
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!--Cookie Alert https://github.com/Wruczek/Bootstrap-Cookie-Alert-->
    <link rel="stylesheet" href="css/cookiealert.css">
	  
	<!-- Scrollbar Custom CSS -->
	  <!--https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css-->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
	  
	<!--Jquery UI -->
	<link rel="stylesheet" href="css/jquery-ui.css">  
	  

    <!-- Custom styles for this template -->
    <style>
      body {
        padding-top: 54px;
		/* Margin bottom by footer height */
	  	margin-bottom: 60px;
      }
      @media (min-width: 992px) {
        body {
          padding-top: 56px;
        }
      }
	/* Sticky footer styles http://getbootstrap.com/docs/4.1/examples/sticky-footer-navbar/ */
	html {
		position: relative;
		min-height: 100%;
	}
	body {

	}
	.footer {
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
		width: 100%;
		/* Set the fixed height of the footer here */
		height: 50px;
		line-height: 50px; /* Vertically center the text there */
		background-color: #f5f5f5;
		
	}
	.footer p {
		padding: 0px;
		margin: 0px;
	}

    </style>
	
	
	<!--Firebase-->
	<script src="https://www.gstatic.com/firebasejs/5.4.0/firebase.js"></script>
	
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
	  <?php if($user->logged && isset($user->user_data['custom_token'])) : ?> 	
	  //Auth 
	  firebase.auth().signInWithCustomToken('<?= $user->user_data['custom_token'] ?>').catch(function(error) {
	  // Handle Errors here.
	  var errorCode = error.code;
	  var errorMessage = error.message;
	  // ...
	});
		
	firebase.auth().onAuthStateChanged(function(user) {
	  if (user) {
		// User is signed in.
		console.log('logeado en firebase');
	  } else {
		alert('Se ha producido un error al logear el usuario en la base de datos.')
	  }
	  // ...
	});
	
	<?php endif ?>
	</script>
	
  </head>
<?php
require_once('../toolkit.php');
//Cargamos la clase de user
$user = new Users;

if(isset($_POST['cat']) && isset($_POST['user']))
{
	//activamos
	$result = $user->userCatNotice($_POST['user'],$_POST['cat'],$_POST['action']);
	if($result)
	{
		echo "success";
		die();
	}
	
}
?>

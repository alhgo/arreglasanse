<?php
//Obtenemos las marcas
$map = new map;
$user = new Users;

if($user->logged){ 
   $marks_config = $user->user_data['marks_config'];
}
else
{
	$marks_config = c::get('marks.config');
}

//Obtenemos las marcas
$marks = $map->getMarks($marks_config);

//print_r($marks);
?>

	<!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block"><!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
      
            <a href="#" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                    <span id="collapse-text" class="menu-collapsed">Cerrar</span>
                </div>
            </a>
			<a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tasks fa-fw mr-3"></span>
                    <span class="menu-collapsed"><select><option value="">Orden</option></select></span>   
                      
                </div>
            </a>
			<p ></p>
  
        </ul><!-- List Group END-->
		<?php foreach($marks AS $key => $val) : ?>
		<div>
			<span class="menu-collapsed" onClick="hideShowMark(<?= $key ?>,false)">Ocultar</span>   
            <span class="menu-collapsed" onClick="hideShowMark(<?= $key ?>,true)">Mostrar</span>  
		</div>
		<?php endforeach ?>
    </div><!-- sidebar-container END -->
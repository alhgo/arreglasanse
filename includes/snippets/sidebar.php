<?php

if($user->logged){ 
   $marks_config = $user->user_data['marks_config'];

}
else
{
	$marks_config = c::get('marks.config');
}


?>

	<!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-lg-block"><!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
      
            <a data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                    <span id="collapse-text" class="menu-collapsed">Cerrar</span>
                </div>
            </a>
			<a class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tasks fa-fw mr-3"></span>
                    <span class="menu-collapsed">
						<select id="marks_order">
							<option value="time_updated" <?= ($marks_config['order'] == 'time_updated' && $marks_config['order_type'] == 'ASC') ? 'selected' : '' ?>>Más reciente</option>
							<option value="time_updated_DESC" <?= ($marks_config['order'] == 'time_updated' && $marks_config['order_type'] == 'DESC') ? 'selected' : '' ?>>Más antigua</option>
							<option value="solved" <?= ($marks_config['order'] == 'solved') ? 'selected' : '' ?>>Resueltas</option>
							<option value="agree" <?= ($marks_config['order'] == 'agree') ? 'selected' : '' ?>>Likes</option>
							<option value="comments" <?= ($marks_config['order'] == 'comments') ? 'selected' : '' ?>>Más comentadas</option>
						</select>
					</span>   
                      
                </div>
            </a>
			<a class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-calendar fa-fw mr-3"></span>
                    <span class="menu-collapsed">
						<select id="marks_ant">
							<option value="5" <?= ($marks_config['ant'] == '5') ? 'selected' : '' ?>>Mostrar todas</option>
							<option value="4" <?= ($marks_config['ant'] == '4') ? 'selected' : '' ?>>Último año</option>
							<option value="3" <?= ($marks_config['ant'] == '3') ? 'selected' : '' ?>>Últimos 6 meses</option>
							<option value="2" <?= ($marks_config['ant'] == '2') ? 'selected' : '' ?>>Últimos 3 meses</option>
							<option value="1" <?= ($marks_config['ant'] == '1') ? 'selected' : '' ?>>Último mes</option>
							<option value="0" <?= ($marks_config['ant'] == '0') ? 'selected' : '' ?>>Última semana</option>
							<?php if($user->logged) : ?>
							<!--Mostrar solo las marcas del usuario-->
							<option value="mine" <?= ($marks_config['ant'] == 'mine') ? 'selected' : '' ?>>Mis marcas</option>
							<?php endif ?>
						</select>
					</span>   
                      
                </div>
            </a>
			<a  class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-search fa-fw mr-3"></span>
                    <span class="menu-collapsed">
						<div class="ui-widget">
						  <input id="tags">&nbsp;<i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true" id="search_icon"></i>
						</div>					
					</span>   
                      
                </div>
            </a>
			
        </ul><!-- List Group END-->
		<h4 class="text-center">Marcas</h4>
		<!--SIDE BAR MARKS -->
		<ul id="side_bar">
			
		</ul>
		
    </div><!-- sidebar-container END -->
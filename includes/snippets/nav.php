<?php 
$user = new users;
$site = new Site;

if($user->logged){ 
   $marks_config = $user->user_data['marks_config'];

}
else
{
	$marks_config = c::get('marks.config');
}


?>
   	<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?= c::get('site.url') ?>">Arregla Sanse</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item<?php echo ($active == 'home') ? ' active' : '' ?>" >
              <a class="nav-link" href="<?= $site->url ?>"><i class="fa fa-home"></i>
                <?php if($active == 'home') : ?>
                <span class="sr-only">(current)</span>
                <?php endif ?>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Acerca de</a>
            </li>
            <?php if($user->logged) : ?>
            <!-- Dropdown -->
			<li class="nav-item dropdown">
			  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				<?= $user->user_data['username'] ?>
			  </a>
			  <div class="dropdown-menu">
				<a class="dropdown-item" href="user.php">Mis datos</a>
				<a class="dropdown-item" href="logout.php">Logout</a>
			  </div>
			</li>
           		<?php if($user->is_admin) : ?>
           		<li class="nav-item">
				  <a class="nav-link" href="admin.php">Panel</a>
				</li>
           		<?php endif ?>
            <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
            </li>
            <?php endif ?>
            <!--sidebar menu, show in small devices-->
            <div class="d-md-block d-lg-none">
                <li class="nav-item"><hr></li>
                
				<li class="nav-item">
					<select id="marks_ant_top">
						<option value="5" <?= ($marks_config['ant'] == '5') ? 'selected' : '' ?>>Mostrar todas</option>
						<option value="4" <?= ($marks_config['ant'] == '4') ? 'selected' : '' ?>>Último año</option>
						<option value="3" <?= ($marks_config['ant'] == '3') ? 'selected' : '' ?>>Últimos 6 meses</option>
						<option value="2" <?= ($marks_config['ant'] == '2') ? 'selected' : '' ?>>Últimos 3 meses</option>
						<option value="1" <?= ($marks_config['ant'] == '1') ? 'selected' : '' ?>>Último mes</option>
						<option value="0" <?= ($marks_config['ant'] == '0') ? 'selected' : '' ?>>Última semana</option>
					</select>
				</li>
            </div>  
              <!-- Smaller devices menu END -->  
          </ul>
        </div>
      </div>
    </nav>
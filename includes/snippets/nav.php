<?php 
$user = new users;
$site = new Site;

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
          </ul>
        </div>
      </div>
    </nav>
<?php



?>
<!-- Bootstrap row -->
<div class="row" id="body-row">
    <?php snippet('sidebar.php',['user' => $user]) ?>
    <!-- MAIN -->
    <div class="col p-0">
        
		<!-- Mapa página principal -->
		<div class="embed-responsive embed-responsive-4by3">
			<div id="map" class="embed-responsive-item" style="padding: 0px"></div>
		</div>

    </div><!-- Main Col END -->
    
</div><!-- body-row END -->

<!-- The Image Modal -->
<div id="markImageModal" class="modal">
  <span class="closeModal">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>



    

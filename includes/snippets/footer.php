<!--MODAL legal notice-->	
<div class="modal fade" id="legalModal">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Condiciones de uso</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
		  Condiciones
     
      </div>

      <!-- Modal footer -->
      <div class="modal-footer" style="display: block">
       	
      </div>
	
    </div>
  </div>
</div>
<!--LEGAL NOTICE-->

<!-- COOKIES -->
<div class="alert text-center cookiealert" role="alert">
    <div class="cookiealert-container">
        <b>En este sitio usamos cookies &#x1F36A; propias y de terceros (menuda sorpresa, ¿no?)</b>  Pincha aquí para aceptar su uso. 

        <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
            Acepto
        </button>
        
        <a href="#" data-toggle="modal" data-target="#legalModal">Más información</a>
    </div>
</div>
<!-- /COOKIES -->


<footer class="footer">
  <div class="container">
	<p class="text-center"><span class="text-muted"><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Licencia de Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a>
		LaUltimaPregunta.com</span></p>
  </div>
</footer>
	<script>
	//Global vars
	var siteUrl = '<?= c::get('site.url') ?>';
    </script>
    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/cookiealert-standalone.js"></script>
    <script src="js/loadingoverlay.js"></script>
	<script src="js/popper.min.js"></script>
	<!--Specific js files-->
	<?php
	if(isset($libs) && is_array($libs))
	{
		foreach($libs AS $lib)
		{
			echo '
	<script src="js/' . $lib . '"></script>';
		}
	}

	
	
	?>



  
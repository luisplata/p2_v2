<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
	<div class="navbar nav_title" style="border: 0;">
	  <a  class="site_title"><img class="img-circle imagen_top"  src="https://pbs.twimg.com/profile_images/732304571985494016/TMNTavT1_reasonably_small.jpg" /><span>UNISINÚ</span></a>
	</div>

	<div class="clearfix"></div>

	<!-- menu profile quick info -->
	<div class="profile clearfix">
	  <div class="profile_pic">
		<img src="http://muellestock.com/css/muellestock/images/usuario-anonimo.png" alt="..." class="img-circle profile_img">
	  </div>
	  <div class="profile_info">
		<span>Hola,</span>
		<h2>{{session("personal")->nombre}}</h2>
	  </div>
	</div>
	<!-- /menu profile quick info -->

	<br />

	<!-- sidebar menu -->
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
		@if(session("personal")->tipo == "DOCTOR")
			@include("Doctor.menu")
		
		@elseif(session("personal")->tipo == "ENFERMERA")
		
		
		@elseif(session("personal")->tipo == "ADMINISTRADOR")
			@include("Administrador.menu")
			
		@elseif(session("personal")->tipo == "ENFERMERA_JEFE")
			@include("EnfermeraJefe.menu")
			
		@elseif(session("personal")->tipo == "ADMISIONISTA")
			@include("Admisionista.menu")
			
		@else
			@include("plantilla.menu")
		@endif

		
	  

	</div>
	<!-- /sidebar menu -->

	<!-- /menu footer buttons -->
	<div class="sidebar-footer hidden-small">
	  <a data-toggle="tooltip" data-placement="top" title="Settings">
		<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
	  </a>
	  <a data-toggle="tooltip" data-placement="top" title="FullScreen">
		<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
	  </a>
	  <a data-toggle="tooltip" data-placement="top" title="Lock">
		<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
	  </a>
	  <a data-toggle="tooltip" data-placement="top" title="Logout">
		<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
	  </a>
	</div>
	<!-- /menu footer buttons -->
  </div>
</div>
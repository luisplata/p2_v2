<!DOCTYPE html>
<html lang="en">
	@include("plantilla.header")
	@yield('plugin-css')
	<style>
		.imagen_top{
			height:40px;
			padding-right:5px;
		}
	</style>
  <body class="nav-md">
    <div class="container body">
		<div class="main_container">
		
		
		
        @include("plantilla.sideMenu")

        @include("plantilla.topMenu")
		<!-- page content -->
		<div class="right_col" role="main">
        @yield('contenido')
		</div>
		<!-- /page content -->

        @include("plantilla.pie")
      </div>
    </div>

    <!-- jQuery -->
	<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
	<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Custom Theme Scripts -->
	
        <script src="{{asset('/js/sweetalert.min.js')}}"></script>
        <script>
            var url_string = window.location;
            var url = new URL(url_string);
            var mensaje = url.searchParams.get("mensaje");
            var tipo = url.searchParams.get("tipo");
            var titulo = url.searchParams.get("titulo");
            if (mensaje != null) {
                swal(titulo == null ? "" : titulo, mensaje, tipo==null?"info":tipo);
            }
        </script>
	@yield('plugin-js')
  </body>
</html>

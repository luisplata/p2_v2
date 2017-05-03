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
	<script src="{{asset('build/js/custom.min.js')}}"></script>

	@yield('plugin-js')
  </body>
</html>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>

            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="http://muellestock.com/css/muellestock/images/usuario-anonimo.png" alt="">usuario
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-                        right">
                        <li><a href="{{url('/principal')}}" target="_blank"><i class="fa fa-sign-out pull-right"></i> Principal</a></li>
                        <li><a href="{{url('/simulador')}}" target="_blank"><i class="fa fa-sign-out pull-right"></i> Simulador</a></li>
                        <li><a href="{{url('/logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
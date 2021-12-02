<div id="navbar-menu">
    <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="" class="img-circle" alt="Avatar"> <span> {{ Session::get('nama') }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a> -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span>{{ Session::get('nama') }}  {{Session::get('level_id')}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>

            <ul class="dropdown-menu">
                <!-- <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
                <li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li> -->
                <li><a href="{{ url('logout') }}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
            </ul>
        </li>

    </ul>
</div>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ $userName }}</strong>
                            </span> <span class="text-muted text-xs block">{{ $userPosition }} <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">(Actions will be added here)</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    JET
                </div>
            </li>
            @include("layouts.navigations.dynamic-tree")
            
        </ul>

    </div>
</nav>

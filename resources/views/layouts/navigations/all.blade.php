
<li class="{{ active_if_current_route_is('dashboard') }}">
    <a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
</li>

@foreach($modules as $module)
<li class="{{ active_if_current_route_is($module->getCode()) }}">
    <a href="{{ url($module->uri()) }}">
        <i class="fa fa-dashboard"></i> 
        <span class="nav-label">Dashboard</span>
    </a>
</li>
@endforeach
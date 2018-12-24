
@foreach($navigationTree->getChildren() as $node)
<li class="{{ $node->isMerelyAContainer() ?: active_if_current_route_is($node->getRoute()) }}">
    <a href="{{ $node->isMerelyAContainer() ? '#' : route($node->getRoute()) }}">
        <i class="{{ $node->getIconClass() }}"></i> 
        <span class="nav-label">{{$node->getText()}}</span>

        @if ($node->getChildCount() > 0) 
        <span class="fa arrow"></span>
        @endif
    </a>

    @if ($node->getChildCount() > 0) 
    <ul class="nav collapse {{ active_if_node_route_is($node, 'in') }}">
        @include("layouts.navigations.dynamic-tree", ['navigationTree' => $node])
    </ul>
    @endif
</li>
@endforeach
<a href="{{url("{$route}/{$id}")}}" data-id="{{$id}}" data-url="{{url($route)}}" class="action-view" data-container="body" data-toggle="tooltip" data-placement="top" title="View">
    <span class="fa fa-search"></span>
</a>

<a href="{{url("{$route}/{$id}/edit")}}" data-id="{{$id}}" data-url="{{url($route)}}" class="action-edit" data-container="body" data-toggle="tooltip" data-placement="top" title="Edit">
    <span class="fa fa-pencil"></span>
</a>

<a href="javascript:void(0)" data-id="{{$id}}" data-url="{{url($route)}}" class="action-delete" data-container="body" data-toggle="tooltip" data-placement="top" title="Delete">
    <span class="fa fa-times"></span>
</a>
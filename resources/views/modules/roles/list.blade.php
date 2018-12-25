<table class="table">
    <thead>
        <tr>        
            <th>Role</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>{{ $role->getName() }}</td>
            <td>
                <a href="javascript:;" action="view-role" data-id="{{ $role->getId() }}">
                    <i class="fa fa-search"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
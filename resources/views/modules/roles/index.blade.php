@extends('layouts.app')

@include('lib.js.sweetalert')
@include('lib.js.blueimp-tmpl')

@section('title', 'Role Management')

@section('js')
<script src="{!! asset('js/app/modules/system/roles/role-form.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/app/modules/system/roles/index-page.js') !!}" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {
    RoleForm.init();
    RoleForm.setRoles(@json($roles));
    IndexPage.init(RoleForm);
});
</script>
@append

@section('content')
@include('modules.roles.templates.role-view')

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-content box-min-height">
                    <h3>Roles</h3>
                    <p class="small"><i class="fa fa-list"></i> Click to View/Edit</p>
                    @include('modules.roles.list')
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-content box-min-height">
                    <h3>Role Information</h3>
                    <p class="small"><i class="fa fa-lock"></i> Access Control List</p>
                    
                    <div class="role-form-container">
                        @include('modules.roles.placeholder')                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@include('lib.vendor.datatables')
@include('lib.vendor.sweetalert')

@section('title', 'Role Management')

@section('js')
{!! $dataTable->scripts() !!}
@append

@section('content')

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content box-min-height">
                    <h3>Roles</h3>
                    {!! $dataTable->table(['class' => 'table table-hover']) !!}
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection

@extends('layouts.app')

@include('lib.vendor.datatables')
@include('lib.vendor.sweetalert')

@section('title', 'Item Management')

@section('js')
{!! $dataTable->scripts() !!}
@append

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h3> Item Management
                        <div class="pull-right">
                            <a href="{{ route('items.create') }}" class="btn btn-primary btn-sm" type="button">
                                <i class="fa fa-plus"></i>
                                New Item
                            </a>
                        </div>
                        <div class="clear-fix"></div>
                    </h3>
                </div>
                <div class="ibox-content box-min-height">                    
                    {!! $dataTable->table(['class' => 'table table-hover']) !!}
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection

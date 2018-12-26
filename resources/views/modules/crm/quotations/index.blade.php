@extends('layouts.app')

@include('lib.vendor.datatables')
@include('lib.vendor.sweetalert')

@section('title', 'Customer Quotations')

@section('js')
{!! $dataTable->scripts() !!}
@append

@section('content')

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h3>
                        Customer Quotations
                        <div class="pull-right">
                            <a href="{{ route('stock-inquiries.create') }}" class="btn btn-primary btn-sm" type="button">
                                <i class="fa fa-check"></i>
                                Canvass / Check Item Stocks
                            </a>
                        </div>
                        <div class="clear-fix"></div>
                    </h3>
                </div>
                <div class="ibox-content box-min-height">                    
                    <div class="row">
                        <div class="col-md-12">
                            {!! $dataTable->table(['class' => 'table table-hover']) !!}
                        </div>
                    </div>                    
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection

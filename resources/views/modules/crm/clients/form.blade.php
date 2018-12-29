@extends('layouts.app')

@include('lib.vendor.sweetalert')

@section('title', 'Client Company Document')

@section('js')

@append

@section('content')

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="ibox ">
                <div class="ibox-title">
                    @include('lib.document-title', ['title' => 'Client Company Document'])
                    <div class="pull-right">
                        @include('lib.tracking-number')
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="form-fields-container">
                        @include('modules.crm.clients.fields')
                    </div>
                </div>
                <div class="ibox-footer">
                    <span class="pull-right">
                        <button class="btn btn-primary" type="button">
                            <i class="fa fa-check"></i>
                            Create
                        </button>

                        <a href="{{ route($documentCloseRoute) }}" class="btn btn-w-m btn-default">
                            Close
                        </a>
                    </span>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

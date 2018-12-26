@extends('layouts.app')

@include('lib.vendor.sweetalert')
@include('lib.vendor.blueimp-tmpl')

@section('title', 'Inquire Item Stocks')

@section('js')
<script src="{!! asset('js/app/item-selection.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/app/modules/pld/stock-inquiries/detail-form.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/app/modules/pld/stock-inquiries/detail-table.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/app/modules/pld/stock-inquiries/form-page.js') !!}" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {
    ItemSelection.init(@json($items));
    DetailForm.init(@json($suppliers), ItemSelection);
    FormPage.init(@json($inquiry), DetailTable, DetailForm);
});
</script>
@append

@section('content')

@include('modules.pld.stock-inquiries.templates.detail-row')
@include('modules.pld.stock-inquiries.templates.detail-form')

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content box-min-height">
                    @include('modules.pld.stock-inquiries.header')

                    <hr/>

                    @include('modules.pld.stock-inquiries.details')          
                </div>
                <div class="ibox-footer">
                    <div class="pull-right">
                        <button action="save" class="btn btn-primary">
                            Create Inquiry
                        </button>

                        <button action="save" class="btn btn-success">
                            Create & Generate Quotation
                        </button>

                        <a href="{{ route($documentCloseRoute) }}" class="btn btn-w-m btn-default">
                            Close
                        </a>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

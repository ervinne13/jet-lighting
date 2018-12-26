@extends('layouts.app')

@include('lib.vendor.sweetalert')
@include('lib.vendor.blueimp-tmpl')

@section('title', 'Inquire Item Stocks')

@section('js')
<script src="{!! asset('js/app/modules/pld/stock-inquiries/detail-form.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/app/modules/pld/stock-inquiries/form-page.js') !!}" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {
    DetailForm.init();    
    FormPage.init(DetailForm);
});
</script>
@append

@section('content')

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-7">
            <div class="ibox">
                <div class="ibox-content box-min-height">
                    <h3>Inquire Item Stocks </h3>                    
                    <div class="form-group">
                        <label>Purpose</label> 
                        <textarea name="purpose" class="form-control"></textarea>
                    </div>

                    <div class="pull-right">
                        <button action="create-detail" class="btn btn-info btn-rounded btn-sm">
                            <i class="fa fa-plus"></i> Create Inquiry Item
                        </button>
                    </div>
                    @include('modules.pld.stock-inquiries.detail-table')

                    <div class="pull-right m-t-lg">
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
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="ibox">
                <div class="ibox-content box-min-height">
                    <h3>Item Information</h3>
                    <div class="detail-form-container">                        
                        @include('modules.pld.stock-inquiries.detail-placeholder')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

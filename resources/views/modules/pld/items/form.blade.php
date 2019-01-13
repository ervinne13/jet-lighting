@extends('layouts.app')

@include('lib.vendor.sweetalert')
@include('lib.vendor.blueimp-tmpl')

@section('title', 'Manage Item Settings')

@section('js')
<script src="{!! asset('js/app/modules/pld/stock-inquiries/detail-form.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/app/modules/pld/stock-inquiries/detail-table-builder.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/app/modules/pld/stock-inquiries/form-page.js') !!}" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {
   
});
</script>
@append

@section('content')

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content box-min-height">

                    <h3 class="text-center">Feature coming soon</h3>

                </div>
                <div class="ibox-footer">
                    <div class="pull-right">
                        <button action="save" class="btn btn-primary">
                            Save Item
                        </button>

                        <a href="{{ route('items.index') }}" class="btn btn-w-m btn-default">
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

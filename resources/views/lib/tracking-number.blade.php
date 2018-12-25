@section('js')
<script src="{!! asset('js/app/tracking-number.js') !!}" type="text/javascript"></script>
@append

<strong id="tracking-number" class="text-navy">
    {{ $trackingNumber }}
</strong>
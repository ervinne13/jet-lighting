@php
$subTitle = null;
if (isset($mode)) {
    switch($mode) {
        case 'view':
            $subTitle = 'View';
            break;
        case 'create':
            $subTitle = 'Create New';
            break;
        case 'edit':
            $subTitle = 'Update Existing';
            break;
    }
}
@endphp

<h5>{{ $title }} 
    @if ($subTitle)
    <small class="m-l-sm">{{ $subTitle }}</small> 
    @endif
</h5>
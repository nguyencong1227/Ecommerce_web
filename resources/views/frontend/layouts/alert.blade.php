@php
    $array_alert = [
        'danger',
        'info',
        'warning',
        'success'
    ];

@endphp
@foreach($array_alert as $item)
    @if (session($item))
        <div class="callout callout-{{ $item }}">
            <p>{{ session($item) }}</p>
        </div>
    @endif
@endforeach
<style>
    .callout-danger {
        text-align: center;
        color: red;
    }
    .callout-success {
        text-align: center;
        color: #0ba011;
    }
</style>
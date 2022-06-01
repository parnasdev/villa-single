@props(['forBtn' => false , 'full' => false , 'type' => 'border' , 'target' => '' , 'class' => ''])
@if($forBtn)
    <span {{ $attributes }} class="spinner-{{$type}} spinner-{{$type}}-sm me-2 {{ $class }}" role="status" aria-hidden="true"></span>
@elseif($full)
    <div class="loader" {{ $attributes }}>
        <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
            <div class="spinner-border text-light" role="status" aria-hidden="true"></div>
            <strong class="text-white">کمی صبر کنید..</strong>
        </div>
    </div>
@else
    <div class="d-flex align-items-center" {{ $attributes }}>
        <strong>چند لحظه صبر کنید...</strong>
        <div class="spinner-{{$type}} {{ $class }} ms-auto" role="status" aria-hidden="true"></div>
    </div>
@endif

@push('styles')
    <style>
        .loader {
            position: absolute;
            left: 0;
            background-color: rgba(0, 0, 0, 0.42);
            z-index: 1000;
            width: 100%;
            height: 100%;
        }
    </style>
@endpush

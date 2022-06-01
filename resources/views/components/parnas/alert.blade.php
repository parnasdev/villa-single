@props(['color' => 'primary' , 'icon' => '','closeBtn' => true])
<div class="alert alert-{{$color}} d-flex align-items-center alert-dismissible fade show" role="alert">
    @if($icon != '')
        <i class="fas {{ $icon }} me-2"></i>
    @endif
    {{ $slot }}
    @if($closeBtn)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>

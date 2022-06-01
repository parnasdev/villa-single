<div class="card {{ $attributes['class'] }}">
    @if($title ?? false)
        <div class="card-header">
            {{ $title }}
        </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>

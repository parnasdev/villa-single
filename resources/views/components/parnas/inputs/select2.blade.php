@props(['ajax' => false , 'api' => '' , 'data' => [] , 'parentContainer' => '$(document.body)'])
@if($ajax)
    <select {{ $attributes }} x-data="
$($el).select2({
                dropdownParent: {{ $parentContainer }},
                ajax: {
                    delay: 1000,
                    url: '{{ $api }}',
                    data: function (params) {
                        var queryParameters = {
                            q: params.term,
                            page: params.page
                        }
                        return queryParameters;
                    },
                    processResults: function (data, params) {
                        params.page = params.page;
                        return {
                            results: data.results,
                            pagination: {more: (params.page * 15) < data.totalCount}
                        };
                    },
                cache: true
                },
                placeholder: '{{ $attributes['placeholder'] }}',
                minimumInputLength: 3,
            });
        @foreach($data as $p)
        newOption = new Option('{{ $p->title ?? $p->name }}', '{{ $p->id }}', true, true);
            $($el).append(newOption).trigger('change')
        @endforeach
        $($el).on('change', function () {
                    var data = $($el).select2('val');
                    @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', data);
            });
">
        {{ $slot }}
    </select>
@else
    <select {{ $attributes }} x-data="
        $($el).select2({
             placeholder: '{{ $attributes['placeholder'] }}',
            dir: 'rtl',
            selectionCssClass: 'form-select',
            allowClear: true,
            dropdownParent: {{ $parentContainer }}
        });
        $($el).on('change', function () {
            var data = $($el).select2('val');
            @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', data);
        });">
        {{ $slot }}
    </select>
@endif

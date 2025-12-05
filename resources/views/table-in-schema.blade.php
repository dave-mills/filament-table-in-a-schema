@php
    use DaveMills\FilamentTableInASchema\FilamentTableInASchema;$extraAttributes = $getExtraAttributes();
    $id = $getId();
@endphp

@if (filled($id) || filled($extraAttributes))
    {!! '<div' !!}
    {{-- Avoid formatting issues with unclosed elements --}}
    {{
        $attributes
            ->merge([
                'id' => $id,
            ], escape: false)
            ->merge($extraAttributes, escape: false)
    }}
    >
@endif

@if (filled($key = $getLivewireKey()))
    @livewire(FilamentTableInASchema::class, [
    'table' => $getTable()
], key($key))
@else
    @livewire(FilamentTableInASchema::class, [
    'table' => $getTable()
])
@endif
@if (filled($id) || filled($extraAttributes))
    {!! '</div>' !!}
    {{-- Avoid formatting issues with unclosed elements --}}
@endif

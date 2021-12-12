@props([
    'actions',
])

@if ($actions instanceof \Illuminate\Contracts\View\View)
    {{ $actions }}
@elseif (is_array($actions))
    @php
        $actions = array_filter(
            $actions,
            fn (\Filament\Pages\Actions\Action $action): bool => ! $action->isHidden(),
        );
    @endphp

    @if (count($actions))
        @php($alignment = config('filament.layout.forms.actions.alignment'))
        <div {{ $attributes->class([
                'flex flex-wrap items-center gap-4',
                $alignment == 'center' ? 'justify-center' : ($alignment == 'right' ? 'justify-end' : '')
            ]) }}>
            @foreach ($actions as $action)
                {{ $action }}
            @endforeach
        </div>
    @endif
@endif

@php
    $state = $getFormattedState();

    $color = $getColor();
    $colorClasses = match ($color) {
        'danger' => 'text-danger-700 bg-danger-500/10 dark:text-danger-500',
        'primary' => 'text-primary-700 bg-primary-500/10 dark:text-primary-500',
        'success' => 'text-success-700 bg-success-500/10 dark:text-success-500',
        'warning' => 'text-warning-700 bg-warning-500/10 dark:text-warning-500',
        null, 'secondary' => 'text-gray-700 bg-gray-500/10 dark:text-gray-300 dark:bg-gray-500/20',
        default => $color,
    };

    $icon = $getIcon();
    $iconPosition = $getIconPosition();
    $iconSize = 'h-4 w-4';
@endphp

<div {{ $attributes->merge($getExtraAttributes())->class([
    'filament-tables-badge-column flex',
    'px-4 py-3' => ! $isInline(),
    match ($getAlignment()) {
        'left' => 'justify-start',
        'center' => 'justify-center',
        'right' => 'justify-end',
        default => null,
    },
]) }}>
    @if (filled($state))
        <div @class([
            'inline-flex items-center justify-center space-x-1 rtl:space-x-reverse min-h-6 px-2 py-0.5 text-sm font-medium tracking-tight rounded-xl whitespace-nowrap',
            $colorClasses,
        ])>
            @if ($icon && $iconPosition === 'before')
                <x-filament::icon
                    :name="$icon"
                    alias="filament-tables::columns.badge.prefix"
                    :size="$iconSize"
                />
            @endif

            <span>
                {{ $state }}
            </span>

            @if ($icon && $iconPosition === 'after')
                <x-filament::icon
                    :name="$icon"
                    alias="filament-tables::columns.badge.suffix"
                    :size="$iconSize"
                />
            @endif
        </div>
    @endif
</div>
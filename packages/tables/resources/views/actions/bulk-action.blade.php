<x-filament::dropdown.list.item
    :x-on:click="'mountBulkAction(\'' . $getName() . '\')'"
    :icon="$getIcon()"
    :color="$getColor()"
    class="filament-tables-bulk-action"
>
    {{ $getLabel() }}
</x-filament::dropdown.list.item>
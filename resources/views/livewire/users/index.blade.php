<div>
    <x-alert color="amber" icon="light-bulb">
        Remember to take a look at the source code to understand how the components in this area were built and are being used.
    </x-alert>

    <div class="mb-2 mt-4">
        <livewire:users.create @created="$refresh" />
    </div>

    <x-table :$headers :$sort :rows="$this->rows" paginate simple-pagination filter>
        @interact('column_created_at', $row)
            {{ $row->created_at->diffForHumans() }}
        @endinteract
        @interact('column_action', $row)
            <div class="flex gap-1">
                <x-button.circle icon="pencil" wire:click="$dispatch('load::user', { 'user' : '{{ $row->id }}'})" />
                <livewire:users.delete :user="$row" :key="uniqid()" @deleted="$refresh" />
            </div>
        @endinteract
    </x-table>

    <livewire:users.update @updated="$refresh" />
</div>

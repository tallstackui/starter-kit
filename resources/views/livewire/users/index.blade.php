<div>
    <x-card>
        <x-alert color="amber" icon="light-bulb">
            @lang('Remember to take a look at the source code to understand how the components in this area were built and are being used.')
        </x-alert>

        <div class="mb-2 mt-4">
            <livewire:users.create @created="$refresh" />
        </div>

        <x-table :$headers :$sort :rows="$this->rows" paginate simple-pagination filter loading :quantity="[2, 5, 15, 25]">
            @interact('column_created_at', $row)
            {{ $row->created_at->diffForHumans() }}
            @endinteract

            @interact('column_action', $row)
            <div class="flex gap-1">
                <x-button.circle icon="pencil" wire:click="$dispatch('load::user', { 'user' : '{{ $row->id }}'})" />
                <livewire:users.delete :user="$row" :key="uniqid('', true)" @deleted="$refresh" />
            </div>
            @endinteract
        </x-table>
    </x-card>

    <livewire:users.update @updated="$refresh" />
</div>

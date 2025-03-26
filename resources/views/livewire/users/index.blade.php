<div>
    <x-table :$headers :rows="$this->rows" paginate simple-pagination filter>
        @interact('column_action', $row)
            <div class="flex gap-1">
                <x-button.circle color="green" icon="pencil" />
                <livewire:users.delete :user="$row" :key="uniqid()" @deleted="$refresh" />
            </div>
        @endinteract
    </x-table>
</div>

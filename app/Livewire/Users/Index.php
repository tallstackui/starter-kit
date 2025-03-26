<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?int $quantity = 10;

    public ?string $search = null;

    public array $headers = [
        ['index' => 'id', 'label' => '#'],
        ['index' => 'name', 'label' => 'Name'],
        ['index' => 'name', 'label' => 'E-mail'],
        ['index' => 'action'],
    ];

    public function render(): View
    {
        return view('livewire.users.index');
    }

    #[Computed]
    public function rows(): LengthAwarePaginator
    {
        return User::query()
            ->when($this->search !== null, fn (Builder $query) => $query->whereAny(['name', 'email'], 'like', '%'.$this->search.'%'))
            ->paginate($this->quantity)
            ->withQueryString();
    }
}

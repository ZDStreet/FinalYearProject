<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class UsersList extends Component
{
    use WithPagination;

    public $search = '';

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        session()->flash('flash.banner', 'User successfully deleted.');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('admin.index');
    }

    public function render()
    {

        $searchTerm = strtolower($this->search);

        $users = User::query()
            ->where(function (Builder $query) use ($searchTerm) {
                $query->whereRaw('LOWER(name) LIKE ?', ["%$searchTerm%"])
                    ->orWhereRaw('LOWER(email) LIKE ?', ["%$searchTerm%"]);
            })
            ->orWhereHas('roles', function (Builder $query) use ($searchTerm) {
                $query->whereRaw('LOWER(name) LIKE ?', ["%$searchTerm%"]);
            })
            ->paginate(12);

        return view('livewire.users-list', compact('users'));
    }
}

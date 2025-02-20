<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class EditUserModal extends Component
{
    public $showEditModal = false;
    public $editUserId;
    public $editUserName;
    public $editUserEmail;
    public $editUserRole;
    public $roles;
    public $selectedRole; 
    public $currentRole;

    protected $listeners = ['editUser'];

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function editUser($userId)
    {
        $user = User::findOrFail($userId);
        $this->editUserId = $user->id;
        $this->editUserName = $user->name;
        $this->editUserEmail = $user->email;
        $this->currentRole = $user->getRoleNames()->first();
        $this->selectedRole = $user->roles->pluck('id')->first() ?: '';

        $this->showEditModal = true;
    }

    public function closeUserEdit()
    {
        $this->reset(['showEditModal', 'editUserId', 'editUserName', 'editUserEmail', 'selectedRole']);
    }

    public function saveUser()
    {
        $user = User::findOrFail($this->editUserId);
        $user->name = $this->editUserName;
        $user->email = $this->editUserEmail;
        if ($this->selectedRole) {
            $user->syncRoles($this->selectedRole);
        }
        $user->save();

        session()->flash('flash.banner', 'User updated.');
        session()->flash('flash.bannerStyle', 'success');
        $this->reset(['showEditModal', 'editUserId', 'editUserName', 'editUserEmail', 'selectedRole']);

        return redirect()->route('admin.index');
    }

    public function render()
    {
        return view('livewire.edit-user-modal');
    }
}

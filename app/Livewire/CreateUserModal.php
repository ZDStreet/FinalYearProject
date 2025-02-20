<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserEmail;

class CreateUserModal extends Component
{
    public $newName; 
    public $newEmail;
    public $newSelectedRole;
    public $showCreateUserModal = false;

    protected $listeners = ['openCreateUserModal' => 'openModal'];

    public function openModal()
    {
        $this->showCreateUserModal = true;
    }

    public function render()
    {
        return view('livewire.create-user-modal', [
            'roles' => Role::all(),
        ]);
    }

    public function createUser()
    {

        $password = Str::random(10);
    
        $user = User::create([
            'name' => $this->newName,
            'email' => $this->newEmail,
            'password' => Hash::make($password),
        ]);
    
        if (!empty($this->newSelectedRole)) {
            $user->assignRole($this->newSelectedRole);
        }
    
        session()->flash('flash.banner', 'User successfully created, user will recive email with login details.');
        session()->flash('flash.bannerStyle', 'success');

        $showCreateUserModal = false;

        Mail::to($this->newEmail)->send(new NewUserEmail(
            "Welcome {$this->newName}, you login deatils are:",
            "Email: {$this->newEmail}",
            "Password: {$password}",
        ));

        return redirect()->route('admin.index');
    }
}
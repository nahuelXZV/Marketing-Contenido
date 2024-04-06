<?php

namespace App\Livewire\System\User;

use App\Services\System\RoleService;
use App\Services\System\UserService;
use Livewire\Component;

class CreateUser extends Component
{
    public $breadcrumbs = [['title' => "Usuarios", "url" => "user.list"], ['title' => "Crear", "url" => "user.create"]];
    public $userArray = [];

    public $roles = [];
    public $areas = [];
    public $positions = [];

    public $validate = [
        'userArray.name' => 'required',
        'userArray.email' => 'required|email',
        'userArray.password' => 'required',
        'userArray.role_id' => 'required',
    ];

    public $message = [
        'userArray.name.required' => 'El nombre es requerido',
        'userArray.email.required' => 'El email es requerido',
        'userArray.email.email' => 'El email no es valido',
        'userArray.password.required' => 'La contraseña es requerida',
        'userArray.role_id.required' => 'El rol es requerido',
    ];

    public function mount()
    {
        $this->userArray = [
            'name' => '',
            'email' => '',
            'password' => '',
            'role_id' => '',
        ];
        $this->roles = RoleService::getAll();
    }

    public function save()
    {
        $this->validate($this->validate, $this->message);
        UserService::create($this->userArray);
        return redirect()->route('user.list');
    }

    public function render()
    {
        return view('livewire.system.user.create-user');
    }
}

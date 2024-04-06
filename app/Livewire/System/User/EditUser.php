<?php

namespace App\Livewire\System\User;

use App\Services\System\RoleService;
use App\Services\System\UserService;
use Livewire\Component;

class EditUser extends Component
{
    public $breadcrumbs = [['title' => "Usuarios", "url" => "user.list"], ['title' => "Editar", "url" => "user.edit"]];
    public $userArray = [];

    public $roles = [];
    public $areas = [];
    public $positions = [];

    public $validate = [
        'userArray.name' => 'required',
        'userArray.email' => 'required|email',
        'userArray.password' => 'nullable',
        'userArray.role_id' => 'required',
    ];

    public $message = [
        'userArray.name.required' => 'El nombre es requerido',
        'userArray.email.required' => 'El email es requerido',
        'userArray.email.email' => 'El email no es valido',
        'userArray.password.required' => 'La contraseña es requerida',
        'userArray.role_id.required' => 'El rol es requerido',
    ];

    public function mount($user)
    {
        $userEntity = UserService::getOne($user);
        $this->userArray = [
            'id' => $userEntity->id,
            'name' => $userEntity->name,
            'email' => $userEntity->email,
            'role_id' => $userEntity->roles[0]->id ?? null,
            'password' => '',
        ];
        $this->roles = RoleService::getAll();
    }

    public function save()
    {
        $this->validate($this->validate, $this->message);
        UserService::update($this->userArray);
        return redirect()->route('user.list');
    }

    public function render()
    {
        return view('livewire.system.user.edit-user');
    }
}

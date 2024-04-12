<?php

namespace App\Livewire\Customer\Customer;

use App\Constants\StateCustomer;
use App\Services\Customer\CustomerService;
use Livewire\Component;

class CreateCustomer extends Component
{
    public $breadcrumbs = [['title' => "Clientes", "url" => "customer.list"], ['title' => "Crear", "url" => "customer.create"]];
    public $customerArray = [];

    public $validate = [
        'customerArray.nombre' => 'required',
        'customerArray.apellido' => 'required',
        'customerArray.telefono' => 'required',
        'customerArray.correo' => 'required|email',
        'customerArray.direccion' => 'required',
        'customerArray.estado' => 'required',
    ];

    public $message = [
        'customerArray.nombre.required' => 'El nombre es requerido',
        'customerArray.apellido.required' => 'El apellido es requerido',
        'customerArray.telefono.required' => 'El telefono es requerido',
        'customerArray.correo.required' => 'El correo es requerido',
        'customerArray.correo.email' => 'El correo no es valido',
        'customerArray.direccion.required' => 'La direccion es requerida',
        'customerArray.estado.required' => 'El estado es requerido',
    ];

    public function mount()
    {
        $this->customerArray = [
            'nombre' => '',
            'apellido' => '',
            'telefono' => '',
            'correo' => '',
            'direccion' => '',
            'estado' => StateCustomer::ACTIVE,
            'company_id' => auth()->user()->company_id,
        ];
    }

    public function save()
    {
        $this->validate($this->validate, $this->message);
        CustomerService::create($this->customerArray);
        return redirect()->route('customer.list');
    }

    public function render()
    {
        return view('livewire.customer.customer.create-customer');
    }
}

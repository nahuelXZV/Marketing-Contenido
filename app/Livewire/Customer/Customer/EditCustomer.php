<?php

namespace App\Livewire\Customer\Customer;

use App\Services\Customer\CustomerService;
use Livewire\Component;

class EditCustomer extends Component
{
    public $breadcrumbs = [];
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

    public function mount($customer)
    {
        $customer = CustomerService::getOne($customer);
        $this->customerArray = [
            'id' => $customer->id,
            'nombre' => $customer->nombre,
            'apellido' => $customer->apellido,
            'telefono' => $customer->telefono,
            'correo' => $customer->correo,
            'direccion' => $customer->direccion,
            'estado' => $customer->estado,
            'company_id' => auth()->user()->company_id,
        ];
        $nameCustomer = $customer->nombre . ' ' . $customer->apellido;
        $this->breadcrumbs = [
            ['title' => "Clientes", "url" => "customer.list"],
            ['title' => $nameCustomer, "url" => "customer.show", "id" => $customer->id],
            ['title' => "Editar", "url" => "customer.edit"]
        ];
    }

    public function save()
    {
        $this->validate($this->validate, $this->message);
        CustomerService::update($this->customerArray);
        return redirect()->route('customer.list');
    }

    public function render()
    {
        return view('livewire.customer.customer.edit-customer');
    }
}

<?php

namespace App\Livewire\Customer\Customer;

use App\Services\Customer\ContractService;
use App\Services\Customer\CustomerService;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCustomer extends Component
{
    use WithPagination;
    public $breadcrumbs = [];
    public $search = '';
    public $customer;

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
        $this->customer = CustomerService::getOne($customer);
        $this->breadcrumbs = [
            ['title' => "Clientes", "url" => "customer.list"],
            ['title' => 'Ver', "url" => "customer.show", "id" => $this->customer->id]
        ];
    }


    public function render()
    {
        $contracts = ContractService::getByCustomerPaginate($this->customer->id, $this->search, 10);
        return view('livewire.customer.customer.show-customer', compact('contracts'));
    }
}

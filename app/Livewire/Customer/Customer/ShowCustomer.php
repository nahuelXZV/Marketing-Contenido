<?php

namespace App\Livewire\Customer\Customer;

use App\Constants\StateCustomer;
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

    public function mount($customer)
    {
        $this->customer = CustomerService::getOne($customer);
        $this->breadcrumbs = [
            ['title' => "Clientes", "url" => "customer.list"],
            ['title' => 'Ver', "url" => "customer.show", "id" => $this->customer->id]
        ];
    }

    public function toggleState()
    {
        if ($this->customer->estado == StateCustomer::ACTIVE) {
            $this->customer->estado = StateCustomer::INACTIVE;
        } else {
            $this->customer->estado = StateCustomer::ACTIVE;
        }
        $this->customer->save();
        $this->customer = CustomerService::getOne($this->customer->id);
    }

    public function render()
    {
        $contracts = ContractService::getByCustomerPaginate($this->customer->id, $this->search, 10);
        return view('livewire.customer.customer.show-customer', compact('contracts'));
    }
}

<?php

namespace App\Livewire\Customer\Contract;

use App\Services\Customer\ContractService;
use App\Services\Customer\CustomerService;
use Livewire\Component;
use Livewire\WithPagination;

class ShowContract extends Component
{
    use WithPagination;
    public $breadcrumbs = [];
    public $search = '';
    public $customer;
    public $contract;

    public function mount($contract)
    {
        $this->contract = ContractService::getOne($contract);
        $this->customer = CustomerService::getOne($this->contract->customer_id);
        $customerName = $this->customer->nombre . ' ' . $this->customer->apellido;
        $this->breadcrumbs = [
            ['title' => "Clientes", "url" => "customer.list"],
            ['title' => $customerName, "url" => "customer.show", "id" => $this->customer->id],
            ['title' => 'Ver', "url" => "customer.show", "id" => $this->customer->id]
        ];
    }

    public function render()
    {
        return view('livewire.customer.contract.show-contract');
    }
}

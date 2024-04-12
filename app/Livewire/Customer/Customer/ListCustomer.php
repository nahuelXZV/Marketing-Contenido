<?php

namespace App\Livewire\Customer\Customer;

use App\Services\Customer\CustomerService;
use Livewire\Component;
use Livewire\WithPagination;

class ListCustomer extends Component
{
    use WithPagination;
    protected $listeners = ['cleanerNotificacion'];

    public $breadcrumbs = [['title' => "Clientes", "url" => "customer.list"]];
    public $search = '';
    public $notificacion = false;
    public $type = '';
    public $message = '';

    public function mount()
    {
    }

    public function cleanerNotificacion()
    {
        $this->notificacion = null;
        $this->search = '';
        $this->type = '';
    }

    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        if (CustomerService::delete($id)) {
            $this->message = 'Eliminado correctamente';
            $this->type = 'success';
        } else {
            $this->message = 'Error al eliminar';
            $this->type = 'error';
        }
        $this->notificacion = true;
    }

    public function render()
    {
        $customers = CustomerService::getAllPaginate($this->search, 15);
        return view('livewire.customer.customer.list-customer', compact('customers'));
    }
}

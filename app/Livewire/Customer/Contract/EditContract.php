<?php

namespace App\Livewire\Customer\Contract;

use App\Constants\ContractStatus;
use App\Constants\ContractType;
use App\Constants\PaymentDetail;
use App\Constants\PaymentStatus;
use App\Services\Customer\ContractService;
use App\Services\Customer\CustomerService;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditContract extends Component
{
    use WithFileUploads;
    public $breadcrumbs;
    public $contractArray = [];
    public $customer;
    public $contract;
    public $documento;

    public $contractStatus;
    public $paymentStatus;
    public $paymentDetail;
    public $contractType;

    public $validate = [
        'contractArray.codigo' => 'required',
        'contractArray.costo' => 'required',
        'contractArray.detalle_pago' => 'required',
        'contractArray.estado_contrato' => 'required',
        'contractArray.tipo_contrato' => 'required',
        'contractArray.estado_pago' => 'required',
        'contractArray.fecha_inicio' => 'required',
        'contractArray.fecha_final' => 'required',
        'contractArray.condiciones' => 'nullable',
        'contractArray.descripcion' => 'nullable',
        'contractArray.customer_id' => 'required',
    ];

    public $message = [
        'contractArray.codigo.required' => 'El codigo es requerido',
        'contractArray.costo.required' => 'El costo es requerido',
        'contractArray.detalle_pago.required' => 'El detalle de pago es requerido',
        'contractArray.descripcion.required' => 'La descripcion es requerida',
        'contractArray.estado_contrato.required' => 'El estado del contrato es requerido',
        'contractArray.tipo_contrato.required' => 'El tipo de contrato es requerido',
        'contractArray.estado_pago.required' => 'El estado del pago es requerido',
        'contractArray.fecha_inicio.required' => 'La fecha de inicio es requerida',
        'contractArray.fecha_final.required' => 'La fecha final es requerida',
        'contractArray.condiciones.required' => 'Las condiciones son requeridas',
        'contractArray.customer_id.required' => 'El cliente es requerido',
    ];

    public function mount($contract)
    {
        $this->contract = ContractService::getOne($contract);
        $this->customer = CustomerService::getOne($this->contract->customer_id);
        $this->contractArray = [
            'id' => $this->contract->id,
            'codigo' => $this->contract->codigo,
            'costo' => $this->contract->costo,
            'detalle_pago' => $this->contract->detalle_pago,
            'descripcion' => $this->contract->descripcion,
            'documento' => $this->contract->documento,
            'estado_contrato' => $this->contract->estado_contrato,
            'tipo_contrato' => $this->contract->tipo_contrato,
            'estado_pago' => $this->contract->estado_pago,
            'fecha_inicio' => $this->contract->fecha_inicio,
            'fecha_final' => $this->contract->fecha_final,
            'condiciones' => $this->contract->condiciones,
            'customer_id' => $this->customer->id,
        ];
        $customerName = $this->customer->nombre . ' ' . $this->customer->apellido;
        $this->breadcrumbs = [
            ['title' => "Clientes", "url" => "customer.list"],
            ['title' => $customerName, "url" => "customer.show", "id" => $this->customer->id],
            ['title' => "Contrato", "url" => "contract.create", "id" => $this->customer->id],
        ];

        $this->contractStatus = ContractStatus::getContractStatus();
        $this->paymentStatus = PaymentStatus::getPaymentStatus();
        $this->paymentDetail = PaymentDetail::getPaymentDetail();
        $this->contractType = ContractType::getContractType();
    }

    public function save()
    {
        try {
            $this->validate($this->validate, $this->message);
            if ($this->documento) {
                $this->contractArray['documento'] = $this->saveFile($this->documento, 'contract');
                $this->deleteFile($this->contract->documento);
            }
            ContractService::update($this->contractArray);
            return redirect()->route('customer.show', ['customer' => $this->customer->id]);
        } catch (\Throwable $th) {
        }
    }

    private function saveFile($file, $path)
    {
        return 'storage/' . Storage::disk('public')->put($path, $file);
    }

    private function deleteFile($path)
    {
        $pathFileOld = str_replace('storage/', '', $path);
        if (Storage::exists($pathFileOld)) Storage::disk('public')->delete($pathFileOld);
    }

    public function render()
    {
        return view('livewire.customer.contract.edit-contract');
    }
}

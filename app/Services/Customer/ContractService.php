<?php

namespace App\Services\Customer;

use App\Models\Contract;

class ContractService
{
    public function __construct()
    {
    }

    static public function getAll()
    {
        $contracts = Contract::all();
        return $contracts;
    }

    static  public function getOne($id)
    {
        $contract = Contract::find($id);
        return $contract;
    }

    static public function getByCustomerPaginate($id, $search, $paginate)
    {
        $contracts = Contract::where('customer_id', $id)
            ->where('codigo', 'ILIKE', '%' . $search . '%')
            ->paginate($paginate);
        return $contracts;
    }

    static public function create($data)
    {
        try {
            $new = Contract::create([
                'costo' => $data['costo'],
                'detalle_pago' => $data['detalle_pago'],
                'descripcion' => $data['descripcion'],
                'documento' => $data['documento'],
                'estado_contrato' => $data['estado_contrato'],
                'tipo_contrato' => $data['tipo_contrato'],
                'estado_pago' => $data['estado_pago'],
                'fecha_inicio' => $data['fecha_inicio'],
                'fecha_final' => $data['fecha_final'],
                'condiciones' => $data['condiciones'],
                'customer_id' => $data['customer_id']
            ]);
            return $new;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static public function update($data)
    {
        try {
            $contract = Contract::find($data['id']);
            $contract->costo = $data['costo'] ?? $contract->costo;
            $contract->detalle_pago = $data['detalle_pago'] ?? $contract->detalle_pago;
            $contract->descripcion = $data['descripcion'] ?? $contract->descripcion;
            $contract->documento = $data['documento'] ?? $contract->documento;
            $contract->estado_contrato = $data['estado_contrato'] ?? $contract->estado_contrato;
            $contract->tipo_contrato = $data['tipo_contrato'] ?? $contract->tipo_contrato;
            $contract->estado_pago = $data['estado_pago'] ?? $contract->estado_pago;
            $contract->fecha_inicio = $data['fecha_inicio'] ?? $contract->fecha_inicio;
            $contract->fecha_final = $data['fecha_final'] ?? $contract->fecha_final;
            $contract->condiciones = $data['condiciones'] ?? $contract->condiciones;
            $contract->customer_id = $data['customer_id'] ?? $contract->customer_id;
            $contract->save();
            return $contract;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static  public function delete($id)
    {
        try {
            $contract = Contract::find($id);
            $contract->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
};

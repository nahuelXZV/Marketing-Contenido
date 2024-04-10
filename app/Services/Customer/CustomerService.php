<?php

namespace App\Services\Customer;

use App\Models\Customer;

class CompanyService
{
    public function __construct()
    {
    }

    static public function getAll()
    {
        $customers = Customer::all();
        return $customers;
    }

    static public function getAllPaginate($attribute, $paginate, $order = "desc")
    {
        $customers = Customer::where('nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('apellido', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('correo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $customers;
    }

    static  public function getOne($id)
    {
        $customer = Customer::find($id);
        return $customer;
    }

    static public function create($data)
    {
        try {
            $new = Customer::create([
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'telefono' => $data['telefono'],
                'correo' => $data['correo'],
                'direccion' => $data['direccion'],
                'estado' => $data['estado'],
                'company_id' => $data['company_id']
            ]);
            return $new;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static public function update($data)
    {
        try {
            $customer = Customer::find($data['id']);
            $customer->nombre = $data['nombre'] ?? $customer->nombre;
            $customer->apellido = $data['apellido'] ?? $customer->apellido;
            $customer->telefono = $data['telefono'] ?? $customer->telefono;
            $customer->correo = $data['correo'] ?? $customer->correo;
            $customer->direccion = $data['direccion']   ?? $customer->direccion;
            $customer->estado = $data['estado'] ?? $customer->estado;
            $customer->company_id = $data['company_id'] ?? $customer->company_id;
            $customer->save();
            return $customer;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static  public function delete($id)
    {
        try {
            $customer = Customer::find($id);
            $customer->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
};

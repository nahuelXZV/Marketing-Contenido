<?php

namespace App\Services\System;

use App\Models\Company;

class CompanyService
{
    public function __construct()
    {
    }

    static  public function getOne($id)
    {
        $company = Company::find($id);
        return $company;
    }

    static public function update($id, $data)
    {
        try {
            $company = Company::find($id);
            $company->nombre = $data['nombre'] ?? $company->nombre;
            $company->direccion = $data['direccion'] ?? $company->direccion;
            $company->telefono = $data['telefono'] ?? $company->telefono;
            $company->correo = $data['correo'] ?? $company->correo;
            $company->foto = $data['foto'] ?? $company->foto;
            $company->logo = $data['logo'] ?? $company->logo;
            $company->slogan = $data['slogan'] ?? $company->slogan;
            $company->descripcion = $data['descripcion'] ?? $company->descripcion;
            return $company;
        } catch (\Exception $e) {
            return false;
        }
    }
};

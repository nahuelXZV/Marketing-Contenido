<?php

namespace App\Services\System;

use App\Constants\CampaignStatus;
use App\Constants\ContractStatus;
use App\Constants\PublicationStatus;
use App\Models\Campaign;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Publication;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class DashboardService
{
    public function __construct()
    {
    }

    static public function getPublicationsByState()
    {
        try {
            $statePublications = PublicationStatus::getAll();
            $cantPublications = [];
            foreach ($statePublications as $statePublication) {
                $cantPublications['labels'][] = $statePublication;
                $cantPublications['counts'][] = Publication::where('estado', $statePublication)->count();
            }

            return $cantPublications;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static public function getUsersByRole()
    {
        try {
            $roles = Role::orderBy('id', 'desc')->take(5)->get();
            $cantidadUsuariosPorRol = [];

            foreach ($roles as $rol) {
                $cantidadUsuarios = User::whereHas('roles', function ($query) use ($rol) {
                    $query->where('role_id', $rol->id);
                })->count();
                $cantidadUsuariosPorRol[] = [
                    'rol' => $rol->name,
                    'cantidad_usuarios' => $cantidadUsuarios,
                    'porcentaje_usuarios' => 0,
                ];
            }
            $totalUsuarios = User::count();

            foreach ($cantidadUsuariosPorRol as &$rol) {
                $rol['porcentaje_usuarios'] = ($rol['cantidad_usuarios'] / $totalUsuarios) * 100;
                $rol['porcentaje_usuarios'] = number_format($rol['porcentaje_usuarios'], 2);
            }

            return $cantidadUsuariosPorRol;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static public function getCampaignByTypes()
    {
        try {
            $stateCampaigns = CampaignStatus::getCampaignStatus();
            $cantCampaignTypes = [];
            foreach ($stateCampaigns as $stateCampaign) {
                $cantCampaignTypes['labels'][] = $stateCampaign;
                $cantCampaignTypes['counts'][] = Campaign::where('estado', $stateCampaign)->count();
            }
            return $cantCampaignTypes;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static public function getCantidadUsers()
    {
        try {
            $cantidadUsuarios = User::count();
            return $cantidadUsuarios;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static public function getCountCustomers()
    {
        try {
            $countCustomers = Customer::count();
            return $countCustomers;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static public function getCantidadCampaigns()
    {
        try {
            $cantidadCampaigns = Campaign::count();
            return $cantidadCampaigns;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static public function getCantidadPublications()
    {
        try {
            $cantidadPublications = Publication::count();
            return $cantidadPublications;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static public function getContractStatus()
    {
        try {
            $stateContracts = ContractStatus::getContractStatus();
            $cantContract = [];
            foreach ($stateContracts as $stateContract) {
                $cantContract['labels'][] = $stateContract;
                $cantContract['counts'][] = Contract::where('estado_contrato', $stateContract)->count();
            }
            return $cantContract;
        } catch (\Throwable $th) {
            return false;
        }
    }
};

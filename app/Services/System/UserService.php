<?php

namespace App\Services\System;

use App\Models\User;

class UserService
{
    public function __construct()
    {
    }

    static public function getAll()
    {
        $users = User::all();
        return $users;
    }

    static public function getAllPaginate($attribute, $paginate, $order = "desc")
    {
        $users = User::where('name', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('email', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $users;
    }

    static  public function getOne($id)
    {
        $user = User::find($id);
        return $user;
    }

    static public function create($data)
    {
        try {
            $new = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);
            $role = RoleService::getOne($data['role_id']);
            $new->assignRole($role->name);
            return $new;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static public function update($data)
    {
        try {
            $user = User::find($data['id']);
            $user->name = $data['name'];
            $user->email = $data['email'];
            if ($data['password'] != '') {
                $user->password = bcrypt($data['password']);
            }
            $user->save();
            if ($user->roles[0]->id != $data['role_id']) {
                $role = RoleService::getOne($data['role_id']);
                $user->syncRoles([$role->name]);
            }
            return $user;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static  public function delete($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
};

<?php

use Datakraf\User;

trait Admin
{

    public function getAllAdmin(): iterable
    {
        $admins = User::whereHas('roles', function ($q) {

            $q->where('name', 'Admin');
            
        })->get();

        return $admins;
    }
}

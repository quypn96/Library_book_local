<?php

namespace App\Repositories\User;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getModel();

    public function getUsersByRole($roleName);

    public function getUsersAlmostDateReturnBook();

    public function getOrCreateUserProviderApi($userApi, $provider);

}

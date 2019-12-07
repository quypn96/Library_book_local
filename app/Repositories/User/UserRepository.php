<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepository;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface;
use App\Enums\BorrowStatusEnum;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{

    public function getModel()
    {
        return User::class;
    }

    public function getUsersByRole($roleName)
    {
        $users = $this->_model->whereHas('role', function ($q) use ($roleName) {
            $q->where('name', $roleName);
        })->get();

        return $users;
    }

    public function getUsersAlmostDateReturnBook()
    {
        $status = BorrowStatusEnum::ACCEPT;
        $date = Helper::addDayForDate(date("Y-m-d"), 3);
        $users = $this->_model
            ->whereHas('borrows', function ($q) use ($date, $status) {
                $q->where('status', $status)
                    ->where('end_date', '<=', $date);
            })
            ->get();

        return $users;
    }

    public function getOrCreateUserProviderApi($userApi, $provider)
    {
        $user = $this->_model->where('provider', $provider)
            ->where('provider_id', $userApi->id)
            ->first();
        if (!$user) {
            $user = $this->_model->create([
                'name' => $userApi->getName(),
                'email' => $userApi->getEmail(),
                'provider' => $provider,
                'provider_id' => $userApi->getId(),
                'avatar' => Helper::saveImageProviderApi($userApi),
                'status' => 1,
                'role_id' => 0,
                'password' => Hash::make($userApi->id),
            ]);
        }

        return $user;
    }

}

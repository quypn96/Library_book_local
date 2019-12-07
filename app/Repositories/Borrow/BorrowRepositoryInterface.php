<?php

namespace App\Repositories\Borrow;

use Illuminate\Http\Request;
use App\Models\User;

interface BorrowRepositoryInterface
{
    public function getModel();

    public function createdByUser(User $user, array $attributes, array $items);

    public function getDataWithRelationship();

    public function updateStatus(Request $request, $id);

    public function getDataByUser(Request $request);

}

<?php

namespace App\Repositories\Borrow;

use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\User;
use Model\Exception;
use App\Repositories\Borrow\BorrowRepositoryInterface;

class BorrowRepository extends EloquentRepository implements BorrowRepositoryInterface
{

    public function getModel()
    {
        return Borrow::class;
    }

    public function createdByUser(User $user, array $attributes, array $items)
    {
        $borrow = $user->borrows()->create($attributes);
        foreach ($items as $item) {
            $borrow->books()->attach($item['id']);
        }

        return $borrow;
    }

    public function getDataWithRelationship()
    {

        return $this->_model::with('user', 'books')->orderBy('created_at', 'desc')->get();
    }

    public function updateStatus(Request $request, $id)
    {
        return $this->_model->where('id', $id)->update([
            'status' => (int)$request->status
        ]);
    }

    public function getDataByUser(Request $request)
    {
        return $request->user()->borrows()->with('books')->orderBy('created_at', 'desc')->get();

    }

}

<?php

namespace App\Repositories\Author;

use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorRepository extends EloquentRepository implements AuthorRepositoryInterface
{

    public function getModel()
    {
        return Author::class;
    }

    public function getDataSortAndPaginate(Request $request, $key, $typeSort, $paginate)
    {
        if ($request->name == null) {

            return $this->_model::orderBy($key, $typeSort)->paginate($paginate);
        } else {

            return $this->_model->where('name', 'like', '%' . $request->name . '%')
                ->orderBy($key, $typeSort)
                ->paginate($paginate);
        }
    }
}

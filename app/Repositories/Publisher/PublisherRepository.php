<?php

namespace App\Repositories\Publisher;

use App\Repositories\EloquentRepository;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Repositories\Publisher\PublisherRepositoryInterface;

class PublisherRepository extends EloquentRepository implements PublisherRepositoryInterface
{

    public function getModel()
    {
        return Publisher::class;
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

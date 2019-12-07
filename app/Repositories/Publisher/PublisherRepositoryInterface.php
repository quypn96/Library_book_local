<?php

namespace App\Repositories\Publisher;

use Illuminate\Http\Request;

interface PublisherRepositoryInterface
{
    public function getModel();

    public function getDataSortAndPaginate(Request $request, $key, $typeSort, $paginate);
}

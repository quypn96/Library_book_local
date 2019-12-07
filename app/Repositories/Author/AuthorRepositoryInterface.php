<?php

namespace App\Repositories\Author;

use Illuminate\Http\Request;

interface AuthorRepositoryInterface
{
    public function getModel();

    public function getDataSortAndPaginate(Request $request, $key, $typeSort, $paginate);
}

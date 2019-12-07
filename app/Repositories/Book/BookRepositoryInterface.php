<?php

namespace App\Repositories\Book;

use Illuminate\Http\Request;

interface BookRepositoryInterface
{
    public function getModel();

    public function filter(Request $request);

    public function getByIdAndColumsName($columsName = [], $id);

    public function getDataSortAndPaginate(Request $request, $key, $typeSort, $paginate);

    public function getAllOrSearch(Request $request);

    public function getDetail($id);

    public function getTotalBookByMonth(Request $request, $month);

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Book\BookRepositoryInterface;

class DashboardController extends Controller
{
    public function __construct(BookRepositoryInterface $bookRepo)
    {
        $this->bookRepo = $bookRepo;
    }

    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function chart(Request $request)
    {
        $months = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
        $data = [];
        foreach ($months as $key => $value) {
            $total = $this->bookRepo->getTotalBookByMonth($request, $value);
            $data[$value] = $total;
        }

        return response()->json($data);
    }
}

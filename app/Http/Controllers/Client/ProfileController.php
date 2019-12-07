<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Borrow\BorrowRepositoryInterface;

class ProfileController extends Controller
{
    public function __construct(BorrowRepositoryInterface $borrowRepository)
    {
        $this->middleware('auth');
        $this->borrowRepository = $borrowRepository;
    }

    public function index(Request $request)
    {
        $borrows = $this->borrowRepository->getDataByUser($request);

        return view('client.profile', [
            'borrows' => $borrows
        ]);
    }
}

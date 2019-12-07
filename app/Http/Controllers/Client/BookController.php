<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Book\BookRepositoryInterface;

class BookController extends Controller
{
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function detail($id)
    {
        $book = $this->bookRepository->getDetail($id);

        return view('client.detail-book', [
            'book' => $book
        ]);
    }
}

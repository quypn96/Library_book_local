<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\StatusEnum;
use App\Repositories\Publisher\PublisherRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Author\AuthorRepositoryInterface;
use App\Repositories\Book\BookRepositoryInterface;

class HomeController extends Controller
{
    public function __construct(
        PublisherRepositoryInterface $publisherRepository,
        CategoryRepositoryInterface $categoryRepository,
        AuthorRepositoryInterface $authorRepository,
        BookRepositoryInterface $bookRepository
    )
    {
        $this->publisherRepository =  $publisherRepository;
        $this->categoryRepository =  $categoryRepository;
        $this->authorRepository =  $authorRepository;
        $this->bookRepository =  $bookRepository;
    }

    public function index(Request $request)
    {
        $publishers = $this->publisherRepository->getAll();
        $categories = $this->categoryRepository->getAll();
        $authors = $this->authorRepository->getAll();

        $books = $this->bookRepository->filter($request);

        return view('client.index', [
            'books' => $books,
            'publishers' => $publishers,
            'categories' => $categories,
            'authors' => $authors
        ]);
    }
}

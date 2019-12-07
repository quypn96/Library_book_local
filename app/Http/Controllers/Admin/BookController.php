<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Author\AuthorRepositoryInterface;
use App\Repositories\Publisher\PublisherRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Helpers\Helper;
use App\Enums\ImageDefault;
use App\Http\Requests\BookRequest;
use App\Exports\BooksExport;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    public function __construct(
        BookRepositoryInterface $bookRepository,
        AuthorRepositoryInterface $authorRepository,
        PublisherRepositoryInterface $publisherRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->authorRepository = $authorRepository;
        $this->publisherRepository = $publisherRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = $this->bookRepository->getAllOrSearch($request)->paginate(10);

        return view('admin.book.index', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = $this->authorRepository->getAll();
        $publishers = $this->publisherRepository->getAll();
        $categories = $this->categoryRepository->getAll();

        return view('admin.book.form-add', [
            'authors' => $authors,
            'publishers' => $publishers,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $dataArray = $request->only([
            'title',
            'categories',
            'author',
            'publisher_id',
            'quantity',
            'description',
            'content',
            'image'
        ]);
        $dataArray['image'] = Helper::saveImage('books', $request->image, ImageDefault::BOOK);

        $book = $this->bookRepository->create($dataArray);
        $dataArray['author'] = array_unique($dataArray['author']);
        $dataArray['categories'] = array_unique($dataArray['categories']);

        $book->authors()->attach($dataArray['author']);
        $book->categories()->attach($dataArray['categories']);

        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authors = $this->authorRepository->getAll();
        $publishers = $this->publisherRepository->getAll();
        $categories = $this->categoryRepository->getAll();

        $book = $this->bookRepository->findOrFail($id);

        return view('admin.book.form-edit', [
            'book' => $book,
            'authors' => $authors,
            'publishers' => $publishers,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id)
    {
        $book = $this->bookRepository->findOrFail($id);
        $dataArray = $request->only([
            'title',
            'categories',
            'author',
            'publisher_id',
            'quantity',
            'description',
            'content',
            'image'
        ]);
        $dataArray['image'] = Helper::saveImage('books', $request->image, $book->image);
        $book->update($dataArray);
        $book->authors()->sync($dataArray['author']);
        $book->categories()->sync($dataArray['categories']);

        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = $this->bookRepository->findOrFail($id);
        $book->authors()->detach();
        $book->categories()->detach();
        $book->delete();

        return redirect()->back();
    }

    public function export(Request $request)
    {
        $books = $this->bookRepository->getAllOrSearch($request)->get();

        $dataArray = [
            [
                'Title',
                'Author',
                'Category',
                'Publisher',
                'Quantity',
            ]
        ];
        foreach ($books as $book) {
            $authorArr = [];
            foreach ($book->authors as $author) {
                array_push($authorArr, $author->name);
            }
            $categoryArr = [];
            foreach ($book->categories as $category) {
                array_push($categoryArr, $category->name);
            }
            $data = [
                'Title' => $book->title,
                'Author' => $authorArr,
                'Category' => $categoryArr,
                'Publisher' => $book->publisher->name,
                'Quantity' => $book->quantity,
            ];
            array_push($dataArray, $data);
        }

        return Excel::download(new BooksExport($dataArray), time() . "books.xlsx");
    }
}

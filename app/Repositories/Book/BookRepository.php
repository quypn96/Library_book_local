<?php

namespace App\Repositories\Book;

use App\Repositories\EloquentRepository;
use App\Repositories\Book\BookRepositoryInterface;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookRepository extends EloquentRepository implements BookRepositoryInterface
{

    public function getModel()
    {
        return Book::class;
    }

    public function filter(Request $request)
    {
        $bookQuery = null;
        if ($request->category != null) {
            $cateId = (int)$request->category;
            $bookQuery = $this->_model::whereHas('categories', function ($query) use ($cateId) {
                $query->where('cate_id', '=', $cateId);
            });
        }

        if ($request->author != null) {
            $authorId = (int)$request->author;
            if ($bookQuery == null) {
                $bookQuery = $this->_model::whereHas('authors', function ($query) use ($authorId) {
                    $query->where('author_id', '=', $authorId);
                });
            } else {
                $bookQuery = $bookQuery->whereHas('authors', function ($query) use ($authorId){
                    $query->where('author_id', '=', $authorId);
                });
            }
        }

        if ($request->publisher != null) {
            $publisherId = (int)$request->publisher;
            if ($bookQuery == null) {
                $bookQuery = $this->_model::where('publisher_id', '=', $publisherId);
            } else {
                $bookQuery= $bookQuery->where('publisher_id', '=', $publisherId);
            }
        }

        if ($bookQuery == null) {

            return $this->_model::orderBy('created_at', 'desc')->paginate(9);
        } else {

            return $bookQuery = $bookQuery->orderBy('created_at', 'desc')->paginate(9);
        }
    }

    public function getByIdAndColumsName($columsName = [], $id)
    {
        return $this->_model::where('id', $id)->first($columsName);
    }

    public function getDataSortAndPaginate(Request $request, $key, $typeSort, $paginate)
    {
        if ($request->title == null) {

            return $this->_model::orderBy($key, $typeSort)->paginate($paginate);
        } else {

            return $this->_model->where('title', 'like', '%' . $request->name . '%')
                ->orderBy($key, $typeSort)
                ->paginate($paginate);
        }
    }

    public function getAllOrSearch(Request $request)
    {
        $books = null;
        if ($request->keyword == null) {
            $books = $this->_model->with('authors', 'publisher')->orderBy('created_at', 'desc');
        } else {
            $books = $this->_model->where('title', 'like', '%' . $request->keyword . '%')
                ->orWhereHas('authors', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->keyword . '%');
                })
                ->orWhereHas('publisher', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->keyword . '%');
                });
        }

        return $books;
    }

    public function getDetail($id)
    {
        return $this->_model->with('authors', 'publisher')->where('id', $id)->firstOrFail();
    }

    public function getTotalBookByMonth(Request $request, $month)
    {

        return $this->_model->whereYear('created_at', $request->year)
            ->whereMonth('created_at', $month)
            ->sum('quantity');
    }

}

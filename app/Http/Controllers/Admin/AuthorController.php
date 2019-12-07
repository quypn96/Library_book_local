<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use App\Repositories\Author\AuthorRepositoryInterface;
use App\Helpers\Helper;
use App\Enums\ImageDefault;
use App\Exports\AuthorsExport;
use Maatwebsite\Excel\Facades\Excel;

class AuthorController extends Controller
{
    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $authors = $this->authorRepository->getDataSortAndPaginate($request, 'id', 'desc', 15);

        return view('admin.author.index', [
            'authors' => $authors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author.form-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorRequest $request)
    {
        $dataArray = $request->only([
            'name',
            'birthday',
            'description',
            'avatar'
        ]);

        $dataArray['avatar'] = Helper::saveImage('avatars', $request->avatar, ImageDefault::AUTHOR);
        $dataArray['birthday'] = Helper::formatDate($dataArray['birthday'], 'Y-m-d');

        $this->authorRepository->create($dataArray);

        return redirect()->route('author.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = $this->authorRepository->find($id);

        return view('admin.author.form-edit', [
            'author' => $author
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorRequest $request, $id)
    {
        $author = $this->authorRepository->findOrFail($id);
        $dataArray = $request->only([
            'name',
            'birthday',
            'description',
            'avatar'
        ]);
        $dataArray['avatar'] = Helper::saveImage('avatars', $request->avatar, $author->avatar);
        $dataArray['birthday'] = Helper::formatDate($dataArray['birthday'], 'Y-m-d');

        $this->authorRepository->update($dataArray, $id);

        return redirect()->route('author.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorRepository->delete($id);

        return redirect()->back();
    }

    public function export(Request $request)
    {
        $authors = $this->authorRepository->getByAttribute('name', 'like', '%' . $request->name . '%');
        $dataArray = [
            [
                'Name',
                'Birthday',
                'Description'
            ]
        ];
        foreach ($authors as $author) {
            $data = [
                'name' => $author->name,
                'birthday' => $author->birthday,
                'description' => $author->description,
            ];
            array_push($dataArray, $data);
        }

        return Excel::download(new AuthorsExport($dataArray), time() . 'authos.xlsx');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Publisher\PublisherRepositoryInterface;
use App\Http\Requests\PublisherRequest;
use App\Helpers\Helper;
use App\Enums\ImageDefault;

class PublisherController extends Controller
{
    public function __construct(PublisherRepositoryInterface $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $publishers = $this->publisherRepository->getDataSortAndPaginate($request, 'id', 'desc', 15);

        return view('admin.publisher.index', [
            'publishers' => $publishers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.publisher.form-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublisherRequest $request)
    {
        $dataArray = $request->only([
            'name',
            'address',
            'image'
        ]);
        $dataArray['image'] = Helper::saveImage('publishers', $request->image, ImageDefault::PUBLISHER);

        $this->publisherRepository->create($dataArray);

        return redirect()->route('publisher.index');
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
        $publisher = $this->publisherRepository->find($id);

        return view('admin.publisher.form-edit', [
            'publisher' => $publisher
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $publisher = $this->publisherRepository->findOrFail($id);
        $dataArray = $request->only([
            'name',
            'address',
            'image'
        ]);
        $dataArray['image'] = Helper::saveImage('publishers', $request->image, $publisher->image);

        $this->publisherRepository->update($dataArray, $id);

        return redirect()->route('publisher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->publisherRepository->delete($id);

        return redirect()->back();
    }

    public function export()
    {
        //
    }
}

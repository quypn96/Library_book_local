<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Borrow\BorrowRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Enums\BorrowStatusEnum;

class BorrowController extends Controller
{
    public function __construct(
        BorrowRepositoryInterface $borrowRepository,
        NotificationRepositoryInterface $notificationRepository
    ) {
        $this->middleware('checkLogin');
        $this->middleware('auth');
        $this->borrowRepository = $borrowRepository;
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrows = $this->borrowRepository->getDataWithRelationship();

        return view('admin.borrow.index', [
            "borrows" => $borrows
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $this->notificationRepository->update([
            'read_at' => date('Y-m-d H:i:s'),
        ], $request->notifi_id);

        $borrow = $this->borrowRepository->findOrFail($id);

        return view('admin.borrow.detail-borrow', [
            'borrow' => $borrow,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $borrow = $this->borrowRepository->updateStatus($request, $id);
        $books = $this->borrowRepository->find($id)->books()->get();

        if ($request->status == BorrowStatusEnum::ACCEPT) {
            foreach ($books as $book) {
                $book->update(['quantity' => $book->quantity - 1]);
            }
        }

        if ($request->status == BorrowStatusEnum::RETURNED) {
            foreach ($books as $book) {
                $book->update(['quantity' => $book->quantity + 1]);
            }
        }

        return response()->json([
            'status' => $borrow
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

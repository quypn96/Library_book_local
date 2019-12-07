<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Borrow\BorrowRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Requests\BorrowRequest;
use App\Notifications\NotificationBorrowBook;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Jobs\SendEmailNotificationForAdmin;

class BorrowController extends Controller
{
    public function __construct(
        BorrowRepositoryInterface $borrowRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->middleware('checkLogin');
        $this->borrowRepository = $borrowRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(BorrowRequest $borrowRequest)
    {
        $listItems = $borrowRequest->session()->has('cart') ? $borrowRequest->session()->get('cart') : null;

        $usersAdmin = $this->userRepository->getUsersByRole('admin');

        if ($listItems != null) {
            $borrow = $this->borrowRepository->createdByUser(
                $borrowRequest->user(),
                $borrowRequest->all(),
                $listItems
            );
            $borrowRequest->session()->forget('cart');

            Notification::send($usersAdmin, new NotificationBorrowBook($borrow));

            SendEmailNotificationForAdmin::dispatch($borrow, $usersAdmin)
                ->delay(now()->addMinutes(1));

            return redirect(route('home'));
        } else {

            return redirect(route('home'));
        }
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
        //
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

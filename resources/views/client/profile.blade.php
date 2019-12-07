<?php
    $count = 1;
?>
@extends('layouts.main-client')
@section('title', trans('client/profile-page.profile'))
@section('content')
    <section>
        <div class="container emp-profile">
            <form>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" width="300" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="profile-head">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#borrow" role="tab" data-toggle="tab">Borrow</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active mt-3" id="profile">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>User Name</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ Auth::user()->name }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Phone</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ Auth::user()->phone_number }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Birthday</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ Helper::formatDate(Auth::user()->birthday) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="borrow">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Books</th>
                                                <th scope="col">Start Date</th>
                                                <th scope="col">End Date</th>
                                                <th scope="col">Note</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($borrows as $borrow)
                                                <tr>
                                                    <th scope="row">{{ $count++ }}</th>
                                                    <td>
                                                        @foreach ($borrow->books as $book)
                                                            <p>{{ $book->title }}</p>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        {{ Helper::formatDate($borrow->start_date) }}
                                                    </td>
                                                    <td>
                                                        {{ Helper::formatDate($borrow->end_date) }}
                                                    </td>
                                                    <td>
                                                        {{ $borrow->note }}
                                                    </td>
                                                    <td>
                                                        {{ BorrowStatus::getConstant($borrow->status) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

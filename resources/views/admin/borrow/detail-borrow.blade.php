@extends('layouts.main-admin')
@section('title', trans('admin/borrow.borrow'))
@section('content')
<div class="m-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="col-xl-8 m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{ $borrow->user->name }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group">
                                            <label for="">Start Date</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control m-input" value="{{ Helper::formatDate($borrow->start_date) }}" id="m_datepicker_3" disabled />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group">
                                            <label for="">End Date</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control m-input" value="{{ Helper::formatDate($borrow->end_date) }}" id="m_datepicker_3" disabled />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group">
                                            <label for="">Status</label>
                                            <div class="input-group date">
                                                <select class="form-control m-input borrow-selected" id="m_sweetalert_demo_3_3" data-id="{{ $borrow->id }}">
                                                    @foreach (BorrowStatus::getArrayConstants() as $key => $value)
                                                        <option value="{{ $value }}" @if ($borrow->status == $value) selected @endif>
                                                            {{ $key }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>{{ trans('admin/book.title') }}</th>
                                                <th>{{ trans('admin/book.author') }}</th>
                                                <th>{{ trans('admin/book.publisher') }}</th>
                                                <th>{{ trans('admin/book.quantity') }}</th>
                                                <th>{{ trans('admin/book.image') }}</th>
                                                <th class="text-center">

                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($borrow->books as $book)
                                                <tr>
                                                    <td>{{$book->id}}</td>
                                                    <td>{{$book->title}}</td>
                                                    <td>
                                                        @foreach ($book->authors as $author)
                                                            <p>{{ $author->name }}</p>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $book->publisher->name }}</td>
                                                    <td>{{$book->quantity}}</td>
                                                    <td>
                                                        <img src="{{asset("storage/".$book->image)}}" width="100">
                                                    </td>
                                                    <td>

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
            </div>
        </div>
    </div>
</div>
@endsection

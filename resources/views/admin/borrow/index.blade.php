@extends('layouts.main-admin')
@section('title', trans('admin/borrow.borrow'))
@section('content')
<div class="m-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{ trans('admin/borrow.list-borrows') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        {{-- <form method="get" class="m-form m-form--fit m--margin-bottom-20">
                            @csrf
                            <div class="row m--margin-bottom-20">
                                <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                                    <input type="text" name="category_name" value="" class="form-control m-input" placeholder="{{ trans('admin/borrow.username') }}" data-col-index="1">
                                </div>
                                <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                                    <select class="form-control m-input" data-col-index="2" name="status">
                                        <option value="">{{ trans('admin/borrow.status') }}</option>
                                        @foreach (BorrowStatus::getArrayConstants() as $key => $value)
                                            <option value="{{ $value }}">
                                                {{ $key }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                                    <button class="btn btn-brand m-btn m-btn--icon" id="m_search">
                                        <span>
                                            <i class="la la-search"></i>
                                            <span>{{ trans('admin/borrow.filter') }}</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="m-separator m-separator--md m-separator--dashed"></div>
                            <div class="row">
                                <div class="col-lg-12">
                                </div>
                            </div>
                        </form> --}}
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>{{ trans('admin/borrow.username') }}</th>
                                                <th>{{ trans('admin/borrow.books') }}</th>
                                                <th>{{ trans('admin/borrow.start-date') }}</th>
                                                <th>{{ trans('admin/borrow.end-date') }}</th>
                                                <th>{{ trans('admin/borrow.note') }}</th>
                                                <th>{{ trans('admin/borrow.status') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($borrows as $borrow)
                                            <tr>
                                                <td>{{$borrow->id}}</td>
                                                <td>{{$borrow->user->name}}</td>
                                                <td>
                                                    @foreach ($borrow->books as $book)
                                                        <p>{{$book->title}}</p>
                                                    @endforeach
                                                </td>
                                                <td>{{Helper::formatDate($borrow->start_date)}}</td>
                                                <td>{{Helper::formatDate($borrow->end_date)}}</td>
                                                <td>{{$borrow->note}}</td>
                                                <td>
                                                    <select class="form-control m-input form-control-sm borrow-selected" id="m_sweetalert_demo_3_3" data-id="{{ $borrow->id }}">
                                                        @foreach (BorrowStatus::getArrayConstants() as $key => $value)
                                                            <option value="{{ $value }}" @if ($borrow->status == $value) selected @endif>
                                                                {{ $key }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                {{-- {{ $books->links() }} --}}
                                            </td>
                                        </tr>

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

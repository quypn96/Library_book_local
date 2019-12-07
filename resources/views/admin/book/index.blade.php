<?php
    $keyword = $_GET['keyword'] ?? "";
?>
@extends('layouts.main-admin')
@section('title', trans('admin/book.list_books'))
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
                                    {{ trans('admin/book.list_books') }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                            <a href="{{route('book.create')}}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air mt-3">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>{{ trans('admin/book.add_new') }}</span>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                            <div class="row align-items-center">
                                <div class="col-xl-8 order-2 order-xl-1">
                                    <form method="get" action="{{ route('book.index') }}" class="m-form m-form--fit m--margin-bottom-20">
                                        @csrf
                                        <div class="row m--margin-bottom-20">
                                            <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
                                                <input type="text" value="{{$keyword}}" name="keyword" class="form-control m-input" placeholder="" data-col-index="1">
                                            </div>
                                            <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                                                <button class="btn btn-brand m-btn m-btn--icon" id="m_search">
                                                    <span>
                                                        <i class="la la-search"></i>
                                                        <span>{{ trans('admin/book.search') }}</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                    <form action="{{ route('book.export') }}" method="get" accept-charset="utf-8">
                                        @csrf
                                        <input type="hidden" name="keyword" value="{{ $keyword }}">
                                        <button class="btn btn-primary m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air" type="submit" title="">
                                            <i class="fa flaticon-download"></i>
                                        </button>
                                    </form>
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
                                            @foreach ($books as $book)
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
                                                        <a href="{{route('book.edit',[ 'book' => $book->id ])}}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">
                                                            <i class="la la-edit"></i>
                                                        </a>

                                                        <a href="javascript:void(0)" title="">
                                                            <form class="delete_confirm" action="{{ route('book.destroy', ['book' => $book->id]) }}" method="POST" id="delete" accept-charset="utf-8">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill btn-remove confirm_delete" title="Delete">
                                                                    <i class="la la-trash"></i>
                                                                </button>
                                                            </form>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    {{ $books->links() }}
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

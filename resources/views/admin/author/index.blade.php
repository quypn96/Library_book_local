<?php
    $searchName = $_GET['name'] ?? "";
?>
@extends('layouts.main-admin')
@section('title', trans('admin/author.author'))
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
                                    {{ trans('admin/author.list_authors') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                            <div class="row align-items-center">
                                <div class="col-xl-8 order-2 order-xl-1">
                                    <form method="get" action="{{ route('author.index') }}" class="m-form m-form--fit m--margin-bottom-20">
                                        @csrf
                                        <div class="row m--margin-bottom-20">
                                            <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">

                                                <input type="text" value="{{$searchName}}" name="name" class="form-control m-input" placeholder="" data-col-index="1">
                                            </div>
                                            <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                                                <button class="btn btn-brand m-btn m-btn--icon" id="m_search">
                                                    <span>
                                                        <i class="la la-search"></i>
                                                        <span>{{ trans('admin/author.search') }}</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                    <form action="{{ route('author.export') }}" method="get" accept-charset="utf-8">
                                        @csrf
                                        <input type="hidden" name="name" value="{{ $searchName }}">
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
                                                <th>{{ trans('admin/author.name') }}</th>
                                                <th>{{ trans('admin/author.birthday') }}</th>
                                                <th>{{ trans('admin/author.description') }}</th>
                                                <th>{{ trans('admin/author.avatar') }}</th>
                                                <th class="text-center">
                                                    <a href="{{route('author.create')}}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                                        <span>
                                                            <i class="la la-plus"></i>
                                                            <span>{{ trans('admin/author.add_new') }}</span>
                                                        </span>
                                                    </a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($authors as $author)
                                                <tr>
                                                    <td>{{$author->id}}</td>
                                                    <td>{{$author->name}}</td>
                                                    <td>{{ Helper::formatDate($author->birthday) }}</td>
                                                    <td>{{$author->description}}</td>
                                                    <td>
                                                        <img src="{{asset("storage/".$author->avatar)}}" width="100">
                                                    </td>
                                                    <td>
                                                        <a href="{{route('author.edit',[ 'author' => $author->id ])}}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">
                                                            <i class="la la-edit"></i>
                                                        </a>

                                                        <a href="javascript:void(0)" title="">
                                                            <form class="delete_confirm" action="{{ route('author.destroy', ['author' => $author->id]) }}" method="POST" id="delete" accept-charset="utf-8">
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
                                                    {{ $authors->links() }}
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

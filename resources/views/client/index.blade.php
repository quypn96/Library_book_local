<?php
    $categoryUrl = $_GET['category'] ?? 0;
    $publisherUrl = $_GET['publisher'] ?? 0;
    $authorUrl = $_GET['author'] ?? 0;
?>
@extends('layouts.main-client')
@section('title', trans('client/home-page.home'))
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <form action="{{ route('home') }}" method="get" accept-charset="utf-8">
                    <div class="left-sidebar">
                        <h2>{{ trans('client/home-page.category') }}</h2>
                        <div class="panel-group category-products" id="">
                            <select name="category" class="custom-select">
                                <option value="">
                                    {{ trans('client/home-page.select_category') }}
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($categoryUrl == $category->id) selected @endif>
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="brands_products">
                            <h2>{{ trans('client/home-page.publisher') }}</h2>
                            <div class="brands-name">
                                <select name="publisher" class="custom-select custom-select-lg mb-3">
                                    <option value="">
                                        {{ trans('client/home-page.select_publisher') }}
                                    </option>
                                    @foreach ($publishers as $publisher)
                                        <option value="{{ $publisher->id }}" @if ($publisherUrl == $publisher->id) selected @endif>
                                            {{$publisher->name}}
                                        </option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="price-range">
                            <h2>{{ trans('client/home-page.author') }}</h2>
                            <div class="brands-name">
                                <select name="author" class="custom-select custom-select-lg mb-3">
                                    <option value="">{{ trans('client/home-page.select_author') }}</option>
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}" @if ($authorUrl == $author->id) selected @endif>
                                            {{$author->name}}
                                        </option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ trans('client/home-page.btn_search') }}</button>
                </form>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">{{ trans('client/home-page.items') }}</h2>
                    @foreach ($books as $book)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{ asset('storage/'. $book->image) }}" width="100" alt="" />
                                        <a href="{{ route('detail', ['id' => $book->id]) }}" title="{{ $book->title }}">
                                            <h4>{{ $book->title }}</h4>
                                        </a>
                                        <h5><span>{{ trans('client/home-page.quantity_available') }}</span>{{ $book->quantity }}</h5>
                                        <button class="btn btn-default add-to-cart borrow" data-id="{{ $book->id }}">
                                            <i class="fa fa-shopping-cart"></i>
                                            {{ trans('client/home-page.borrow') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li>
                                            @include('commons.client.like', ['book' => $book])
                                        </li>
                                        <li>
                                            @include('commons.client.follow', ['book' => $book])
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('layouts.main-admin')
@section('title', trans('admin/book.edit_book'))
@section('content')
<div class="m-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                                <span class="m-portlet__head-icon m--hide">
                                                    <i class="la la-gear"></i>
                                                </span>
                                <h3 class="m-portlet__head-text">
                                    {{ trans('admin/book.edit_book') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <form enctype="multipart/form-data"
                    action="{{ route('book.update', ['book' => $book->id]) }}"
                    method="post" class="m-form m-form--fit m-form--label-align-right">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <label for="">{{ trans('admin/book.title') }}</label>
                                        <input type="text" name="title" class="form-control m-input" value="{{ $book->title }}" placeholder="">
                                        @if($errors)
                                            <span class="text-danger">{{$errors->first('title')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group" id="categories">
                                        <label for="">{{ trans('admin/book.category') }}</label>
                                        <div class="input-group control-group after-add-category " >
                                            @foreach ($book->categories as $c)
                                                <select name="categories[]" class="form-control m-input col-md-10" id="exampleSelect2">
                                                    <option value="">{{ trans('admin/book.choose_category') }}</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" @if ($c->id == $category->id) selected @endif>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select><br>
                                            @endforeach
                                            <div class="input-group-btn">
                                                <button class="btn btn-success add-category-select" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                            </div>
                                        </div>
                                        @if($errors)
                                            <span class="text-danger">{{$errors->first('categories.*')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="">{{ trans('admin/book.publisher') }}</label>
                                        <select name="publisher_id" class="form-control m-input col-md-10" id="">
                                            <option value="">{{ trans('admin/book.choose_publisher') }}</option>
                                            @foreach ($publishers as $publisher)
                                                <option value="{{ $publisher->id }}" @if ($book->publisher_id == $publisher->id) selected @endif>
                                                    {{ $publisher->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors)
                                            <span class="text-danger">{{$errors->first('publisher_id')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputEmail1">{{ trans('admin/book.image') }}</label>
                                        <div class="custom-file">
                                            <input type="file" name="image" class="form-control custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">{{ trans('admin/book.choose_image') }}</label>
                                        </div>
                                        @if($errors)
                                            <span class="text-danger">{{$errors->first('image')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group" id="authors">
                                        <label for="">{{ trans('admin/book.author') }}</label>
                                        <div class="input-group control-group after-add-author" >
                                            @foreach ($book->authors as $a)
                                                <select name="author[]" class="form-control m-input col-md-10" id="exampleSelect1">
                                                    <option value="">{{ trans('admin/book.choose_author') }}</option>
                                                    @foreach ($authors as $author)
                                                        <option value="{{ $author->id }}" @if ($a->id == $author->id) selected @endif>
                                                            {{ $author->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endforeach
                                            <div class="input-group-btn">
                                                <button class="btn btn-success add-author-select" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                            </div>
                                        </div>
                                        @if($errors)
                                            <span class="text-danger">{{$errors->first('author.*')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group m-form__group">
                                        <label for="">{{ trans('admin/book.quantity') }}</label>
                                        <input type="number" name="quantity" class="form-control m-input" value="{{ $book->quantity }}" placeholder="">
                                        @if($errors)
                                            <span class="text-danger">{{$errors->first('quantity')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group m-form__group">
                                    <label for="">{{ trans('admin/book.description') }}</label>
                                    <textarea name="description" class="summernote" id="m_summernote_1" rows="10">
                                        {{ $book->description }}
                                    </textarea>
                                    @if($errors)
                                        <span class="text-danger">{{$errors->first('description')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group m-form__group">
                                    <label for="">{{ trans('admin/book.content') }}</label>
                                    <textarea name="content" class="summernote" id="m_summernote_1" rows="10">
                                        {{ $book->content }}
                                    </textarea>
                                    @if($errors)
                                        <span class="text-danger">{{$errors->first('content')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="submit" class="btn btn-success">{{ trans('admin/form.btn_save') }}</button>
                                <a href="{{route('book.index')}}" type="reset" class="btn btn-secondary">{{ trans('admin/form.btn_cancel') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="copy-author d-none">
    <div class="control-group input-group" style="margin-top:10px">
        <select name="author[]" class="form-control m-input col-md-10" id="exampleSelect1">
            <option value="">{{ trans('admin/book.choose_author') }}</option>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}">
                    {{ $author->name }}
                </option>
            @endforeach
        </select>
        <div class="input-group-btn">
            <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
        </div>
    </div>
</div>
<div class="copy-category d-none">
    <div class="control-group input-group" style="margin-top:10px">
        <select name="categories[]" class="form-control m-input col-md-10" id="exampleSelect1">
            <option value="">{{ trans('admin/book.choose_author') }}</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <div class="input-group-btn">
            <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
        </div>
    </div>
</div>
@endsection

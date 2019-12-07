@extends('layouts.main-admin')
@section('title', trans('admin/author.create_author'))
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
                                    {{ trans('admin/author.create_author') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <form enctype="multipart/form-data"
                    action="{{ route('author.store') }}"
                    method="post" class="m-form m-form--fit m-form--label-align-right">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <label for="">{{ trans('admin/author.name') }}</label>
                                        <input type="text" name="name" class="form-control m-input" value="" placeholder="">
                                        @if($errors)
                                            <span class="text-danger">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="">{{ trans('admin/author.birthday') }}</label>
                                        <div class="input-group date">
                                            <input type="text" name="birthday" class="form-control m-input" value="" id="m_datepicker_3" />
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                        @if($errors)
                                            <span class="text-danger">{{$errors->first('birthday')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputEmail1">{{ trans('admin/author.avatar') }}</label>
                                        <div class="custom-file">
                                            <input type="file" name="avatar" class="form-control custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">{{ trans('admin/author.choose_image') }}</label>
                                        </div>
                                        @if($errors)
                                            <span class="text-danger">{{$errors->first('avatar')}}</span>
                                        @endif
                                        <div class="">
                                            <img id="imageTarget" src="" class="img-responsive"style="width: 100%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group m-form__group">
                                    <label for="">{{ trans('admin/author.description') }}</label>
                                    <textarea name="description" class="summernote" id="m_summernote_1" rows="10">

                                    </textarea>
                                    @if($errors)
                                        <span class="text-danger">{{$errors->first('description')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="submit" class="btn btn-success">{{ trans('admin/form.btn_save') }}</button>
                                <a href="{{route('author.index')}}" type="reset" class="btn btn-secondary">{{ trans('admin/form.btn_cancel') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

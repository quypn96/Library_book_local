@extends('layouts.main-admin')
@section('title', trans('admin/publisher.create_publisher'))
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
                                    {{ trans('admin/publisher.create_publisher') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <form enctype="multipart/form-data"
                    action="{{ route('publisher.store') }}"
                    method="post" class="m-form m-form--fit m-form--label-align-right">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <label for="">{{ trans('admin/publisher.name') }}</label>
                                        <input type="text" name="name" class="form-control m-input" value="" placeholder="">
                                        @if($errors)
                                            <span class="text-danger">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="">{{ trans('admin/publisher.address') }}</label>
                                        <input type="text" name="address" class="form-control m-input" value="" placeholder="">
                                        @if($errors)
                                            <span class="text-danger">{{$errors->first('address')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputEmail1">{{ trans('admin/publisher.image') }}</label>
                                        <div class="custom-file">
                                            <input type="file" name="image" class="form-control custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">{{ trans('admin/publisher.choose_image') }}</label>
                                        </div>
                                        @if($errors)
                                            <span class="text-danger">{{$errors->first('image')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    <button type="submit" class="btn btn-success">{{ trans('admin/form.btn_save') }}</button>
                                    <a href="{{route('publisher.index')}}" type="reset" class="btn btn-secondary">{{ trans('admin/form.btn_cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

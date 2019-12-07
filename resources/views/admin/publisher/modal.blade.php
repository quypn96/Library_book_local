<div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('admin/publisher.create_publisher') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data"
                    action="{{ route('publisher.store') }}"
                    method="post" class="m-form m-form--fit m-form--label-align-right">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
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
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">{{ trans('admin/publisher.image') }}</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="form-control custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">
                                            {{ trans('admin/publisher.choose_image') }}
                                        </label>
                                    </div>
                                    @if($errors)
                                        <span class="text-danger">{{$errors->first('avatar')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ trans('admin/form.btn_cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ trans('admin/form.btn_save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

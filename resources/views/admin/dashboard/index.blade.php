@extends('layouts.main-admin')
@section('title', trans('admin/form.title_dashboard'))
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="m-portlet col-md-12">
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                    <label for="">Year</label>
                                    <div class="input-group date">
                                        <select class="form-control m-input year" id="m_sweetalert_demo_3_3">
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>
        </div>
    </div>
@section('js')
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
@endsection
@endsection

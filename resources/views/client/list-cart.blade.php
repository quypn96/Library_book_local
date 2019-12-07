@extends('layouts.main-client')
@section('title', trans('client/cart-page.cart'))
@section('content')
    <section>
        <div class="container">
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">{{ trans('client/cart-page.item') }}</td>
                            <td class="description">{{ trans('client/cart-page.title') }}</td>
                            <td class="total">{{ trans('client/cart-page.btn_delete') }}</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody class="list-items">
                        @foreach ($listItems as $item)
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="{{ asset('storage/' . $item['image']) }}" width="100" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $item['title'] }}</a></h4>
                                </td>
                                <td class="cart_delete">
                                    <a href="javascript:void(0)" class="cart_quantity_delete delete-item" data-id={{ $item['id'] }}>
                                        <i class="fa fa-times" >
                                        </i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-md-12">
                    <form action="{{ route('borrows.store') }}" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">{{ trans('client/cart-page.start_date') }}</label>
                                <input type="date" class="form-control" name="start_date">
                                @if ($errors->has('start_date'))
                                    <div class="error text-danger">{{ $errors->first('start_date') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">{{ trans('client/cart-page.end_date') }}</label>
                                <input type="date" class="form-control" name="end_date">
                                @if ($errors->has('end_date'))
                                    <div class="error text-danger">{{ $errors->first('end_date') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('client/cart-page.note') }}</label>
                                <textarea name="note" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                                @if ($errors->has('note'))
                                    <div class="error text-danger">{{ $errors->first('note') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col text-center">
                            <button type="submit" class="btn btn-success center" type="">{{ trans('client/cart-page.btn_borrow') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

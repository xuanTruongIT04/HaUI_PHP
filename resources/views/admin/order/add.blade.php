@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sửa thông tin đơn hàng
                <a href="{{ route("admin.order.import_excel") }}" class="ml-2 btn btn-primary">IMPORT FILE EXCEL</a>
            </div>
            <div class="card-body">
                <form action="{{ url("admin/order/store") }}" method='POST'>
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên khách hàng</label>
                        <input class="form-control" type="text" name="customer_name" id="name"
                            value="{{ Old('customer_name') }}">
                        @error('customer_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="number-phone">Số điện thoại</label>
                        <input class="form-control" type="text" name="number_phone" id="number-phone"
                            value="{{ Old('number_phone') }}">
                        @error('number_phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email"
                            value="{{ Old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address-delivery">Địa chỉ nhận hàng</label>
                        <input class="form-control" type="text" name="address_delivery" id="address-delivery"
                            value="{{ Old('address_delivery') }}">
                        @error('address_delivery')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="notes">Ghi chú từ khách hàng</label>
                        <textarea class="form-control no-edit" name="notes" readonly="readonly" id="notes" cols="30" rows="10">{{ Old('notes') }}</textarea>
                        @error('notes')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="time_book">Thời gian đặt</label><BR>
                        <input class="form-control w-17" type="date" name="time_book" id="time_book" /><BR>
                        @error('time_book')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="time_export">Thời gian xuất</label> <BR>
                        <input class="form-control w-17" type="date" name="time_export" id="time_export"/><BR>
                        @error('time_export')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="payment-method">Hình thức thanh toán</label> <BR>
                        {!! show_payment_method(Old('payment_method')) !!} <BR>
                        @error('payment_method')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                            <div class="form-group">
                                <label for="" class="fw-550">Sản phẩm</label> <BR>
                                <select class="form-control w-30" name="product_id">
                                    @foreach ($list_product as $item)
                                        <option value="{{$item->id}}">{{$item->product_name}}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @error('product_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="number-order" class="fw-550">Số lượng sản phẩm</label> <BR>
                        <input class="form-control w-10" type="number" min="0" value="@php if(!empty(Old("number_order"))) echo Old("number_order"); else echo "0"; @endphp" name="number_order"
                            id="number-order">
                        @error('qty_import')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>



                    <input type="submit" name="btn_update" class="btn btn-primary" value="Thêm mới">
                </form>
            </div>
        </div>
    </div>
@endsection

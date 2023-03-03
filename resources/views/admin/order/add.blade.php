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
                        <label for="payment-method">Hình thức thanh toán</label> <BR>
                        {!! show_payment_method(Old('payment_method')) !!} <BR>
                        @error('order_status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Trạng thái đơn hàng</label><BR>
                        {!! show_order_status(Old('order_status')) !!}<BR>
                        @error('order_status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <input type="submit" name="btn_update" class="btn btn-primary" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>
@endsection

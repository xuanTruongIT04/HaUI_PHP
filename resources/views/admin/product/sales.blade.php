@extends('layouts.admin')
@php
    $total_product_sales = get_total_product_sales();
@endphp

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách đơn hàng THÀNH CÔNG <span class=" ml-3 badge badge-warning sales">Doanh số:
                        {!! number_format($total_product_sales) !!} VNĐ</span></h5>
                <div class="form-search form-inline">
                    <form action="#" method="" action="">
                        @csrf
                        <input type="text" class="form-control form-search" name="key_word"
                            value="{{ request()->input('key_word') }}" placeholder="Tìm kiếm theo tên khách hàng...">
                        <input type="submit" name="btn_search" value="Tìm kiếm" class="btn btn-primary">
                        <input type="hidden" name="status"
                            value="{{ empty(request()->input('status')) ? 'active' : request()->input('status') }}" />
                    </form>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/product/sales') }}" method="GET">
                    <div class="form-action form-inline">
                        <div class="mr-5 text-left ">
                            <label for="start-date" class="d-block mb-2">Ngày bắt đầu</label>
                            <input class="form-control" type="date" name="start_date" value="{{ Old('start_date') }}">
                        </div>
                        <div class="">
                            <label for="end-date" class="d-block mb-2">Ngày kết thúc</label>
                            <input class="form-control" type="date" name="end_date" value="{{ Old('end_date') }}">
                        </div>
                    </div>
                    <input type="submit" name="btn_filter" value="Áp dụng" class="my-2 mt-3 btn btn-primary">
                    @if (!empty(request()->btn_filter))
                        <div class="count-user"><span>Kết quả tìm kiếm từ {!! time_format( request() -> input("start_date")) !!}
                            đến ngày {!! time_format( request() -> input("end_date")) !!} là:
                            <b>{{ $count_order }}</b> đơn hàng</span></div>
                    @endif
                    @if (!empty(request()->key_word))
                        <div class="count-user"><span>Kết quả tìm kiếm: <b>{{ $count_order }}</b> đơn hàng</span></div>
                    @endif
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkAll">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Tổng giá</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thời gian giao</th>
                                @if (request()->status != 'trashed')
                                    <th scope="col">Chi tiết</th>
                                @endif
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($count_order > 0)
                                @php
                                    $total_price = 0;
                                    $cnt = empty(request()->page) ? 0 : (request()->page - 1) * 20;
                                @endphp
                                @foreach ($orders as $order)
                                    @php
                                        $total_price = get_total_price_order($order->id);
                                        $cnt++;
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="list_check[]" value="{{ $order->id }}"">
                                        </td>
                                        <th scope=" row">{{ $cnt }}</th>
                                        <td><a class="text-primary"
                                                href="{{ route('admin.order.edit', $order->id) }}">{{ $order->order_code }}</a>
                                        </td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{!! currency_format($total_price) !!}</td>
                                        <td>{!! field_status_order($order->order_status) !!}</td>
                                        <td>{{ $order->time_export }}</td>
                                        @if (request()->status != 'trashed')
                                            <td><a href="{{ route('admin.order.detail', $order->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Chi tiết">Chi tiết</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.order.edit', $order->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                                {{-- <a href="{{ route('admin.order.delete', $order->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xoá đơn hàng {{ $order->order_code }}?')"
                                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></a> --}}
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ route('admin.order.restore', $order->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip"
                                                    onclick="return confirm('Bạn có chắc chắn muốn khôi phục đơn hàng {{ $order->order_code }}?')"
                                                    data-placement="top" title="Restore"><i
                                                        class="fas fa-trash-restore-alt"></i></a>
                                                {{-- <a href="{{ route('admin.order.delete', $order->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xoá vĩnh viễn đơn hàng {{ $order->order_code }}?')"
                                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></a> --}}
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="bg-white">Không tìm thấy đơn hàng nào!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                {{ $orders->links() }}
            </div>
        </div>
    </div>

@endsection

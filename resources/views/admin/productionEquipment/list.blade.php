@extends('layouts.admin')


@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        @if (Session::has('message'))
            <div class="alert alert-success">
            {{ Session('message') }}
            </div>
        @endif

        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <div id="title-btn-add">
                <h5 class="m-0 ">Danh sách thiết bị sản xuất</h5>
                <a href="{{ Route("admin.productionEquipment.add") }}" class="btn btn-primary ml-3">THÊM MỚI</a>
            </div>

            <div class="form-search form-inline">
                <form action="#" method="GET">
                    @csrf
                    <input type="text" class="form-control form-search" name="key_word"
                        value="{{ request()->input('key_word') }}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn_search" value="Tìm kiếm" class="btn btn-primary">
                    <input type="hidden" name="status"
                        value="{{ empty(request()->input('status')) ? 'active' : request()->input('status') }}" 
                    />
                </form>
            </div>
        </div>
        <div class="card-body">
            <form action="" method="GET">
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkAll">
                            </th>
                            <th scope="col">STT</th>
                            <th scope="col">Tên thiết bị</th>
                            <th scope="col">Tình trạng</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá thành</th>
                            <th scope="col">Thời gian sản xuất</th>
                            <th scope="col">Thời gian bảo dưỡng</th>
                            <th scope="col">Thông số kỹ thuật</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Mã tổ sản xuất</th>
                            <th scope="col">Thao tác</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $cnt = empty(request()->page) ? 0 : (request()->page - 1) * 20;
                        @endphp
                        @foreach ($productionEquipments as $item)
                            @php
                            $cnt++;
                            @endphp
                            <tr>
                                <td>
                                    <input type="checkbox" name="list_check[]" value="{{ $item->id }}">
                                </td>
                                <td>{{ $cnt }}</td>
                                <td>{{ $item->equipment_name }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->output_time }}</td>
                                <td>{{ $item->maintenance_time }}</td>
                                <td>{{ $item->specifications }}</td> 
                                <td>{{ $item->describe }}</td>                              
                                <td>{{ $item->production_team_id }}</td>                              
                                <td> 
                                    <a href="{{Route("admin.productionEquipment.edit", $item->id)}}" class="btn btn-info">Sửa</a>
                                    <a href="{{Route("admin.productionEquipment.delete", $item->id)}}" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            
            {{ $productionEquipments->links() }}
        </div>
    </div>
    </div>

@endsection


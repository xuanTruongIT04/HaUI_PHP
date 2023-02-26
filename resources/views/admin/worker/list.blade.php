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
            <h5 class="m-0 ">Danh sách công nhân</h5>
            <a href="{{ Route("admin.worker.add") }}" class="btn btn-primary ml-3">THÊM MỚI</a>
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
        <div class="analytic">
            <a href="{{ request()->fullUrlWithQuery(['status' => 'all']) }}" class="text-primary">
                Tất cả
                <span class="text-muted">({{ $count_worker_status[0] }})</span>
            </a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'working']) }}" class="text-primary">
                Đang làm việc
                <span class="text-muted">({{ $count_worker_status[1] }})</span>
            </a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'quit']) }}" class="text-primary">
                Đã nghỉ việc
                <span class="text-muted">({{ $count_worker_status[2] }})</span>
            </a>
        </div>
        <br>
        <form action="" method="GET">
            <table class="table table-striped table-checkall">
                <thead>
                <tr>
                    <th>
                        <input type="checkbox" name="checkAll">
                    </th>
                    <th scope="col">STT</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Số ngày làm việc</th>
                    <th scope="col">Số giờ tăng ca</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $cnt = empty(request()->page) ? 0 : (request()->page - 1) * 20;
                        @endphp
                    @foreach ($workers as $item)
                        @php
                            $cnt++;
                            
                        @endphp
                        <tr>
                        <td>
                            <input type="checkbox" name="list_check[]" value="{{ $item->id }}">
                        </td>
                        <td>{{$cnt}}</td>
                        <td>{{$item->worker_name}}</td>
                        <td>{{Carbon\Carbon::createFromFormat('Y-m-d', $item->birthday)->format('d/m/Y')}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->number_of_working_days}}</td>
                        <td>{{$item->number_of_overtime}}</td>
                        <td>{{$item->status == 1 ? "Đang làm việc" : "Đã nghỉ việc"}}</td>
                        <td>
                            <a href="{{Route("admin.worker.edit", $item->id)}}" class="btn btn-info">Cập nhật</a>
                            <a href="{{Route("admin.worker.delete", $item->id)}}" class="btn btn-danger">Xóa</a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        {{ $workers->links() }}
    </div>

</div>

@endsection

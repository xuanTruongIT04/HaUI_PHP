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
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Tuổi</th>
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
                              <td>{{$item->old}}</td>
                              <td>{{$item->address}}</td>
                              <td>{{$item->number_of_working_days}}</td>
                              <td>{{$item->number_of_overtime}}</td>
                              <td>{{$item->status == 1 ? "Đang làm việc" : "Đã nghỉ việc"}}</td>
                              <td>
                                <a href="{{Route("admin.worker.edit", $item->id)}}" class="btn btn-info">Cập nhật</a>
                              </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            {{ $workers->links() }}
        </div>
      </div>
    </div>

@endsection

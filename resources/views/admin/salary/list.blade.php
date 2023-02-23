@extends('layouts.admin')
//test

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
          <h5 class="m-0 ">Bảng lương</h5>
          <a href="{{ Route("admin.productionTeam.add") }}" class="btn btn-primary ml-3">THÊM MỚI</a>
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
                        <th scope="col">Tên tổ sản xuất</th>
                        <th scope="col">Mã bộ phận</th>
                        <th scope="col">Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                          $cnt = empty(request()->page) ? 0 : (request()->page - 1) * 20;
                        @endphp
                        @foreach ($productionTeams as $item)
                            @php
                              $cnt++;
                            @endphp
                            <tr>
                              <td>
                                <input type="checkbox" name="list_check[]" value="{{ $item->id }}">
                              </td>
                              <td>{{$cnt}}</td>
                              <td>{{$item->production_team_name}}</td>
                              <td>{{$item->department_id}}</td>
                              <td>
                                <a href="{{Route("admin.productionTeam.edit", $item->id)}}" class="btn btn-info">Sửa</a>
                                <a href="{{Route("admin.productionTeam.delete", $item->id)}}" class="btn btn-danger">Xóa</a>
                              </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            {{ $productionTeams->links() }}
        </div>
      </div>
    </div>

@endsection

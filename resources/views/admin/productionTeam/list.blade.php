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
          <h5 class="m-0 ">Danh sách tổ sản xuất</h5>
          <a href="{{ Route("admin.productionTeam.add") }}" class="btn btn-primary ml-3">THÊM MỚI</a>
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
            <form action="{{ Route("admin.productionTeam.list") }}" method="GET">
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" name="filter_dep" id="">
                        <option value="">Chọn bộ phận</option>
                        @foreach ($listDepartment as $item)
                            <option value="{{ $item->id }}">{{ $item->department_name }}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
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

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
          <h5 class="m-0 ">Danh sách ca làm việc</h5>
          <a href="{{ Route("admin.workshift.add") }}" class="btn btn-primary ml-3">THÊM MỚI</a>
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
                        <th scope="col">Mã ca làm việc</th>
                        <th scope="col">Thời gian bắt đầu</th>
                        <th scope="col">Thời gian kết thúc</th>
                        <th scope="col">Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                          $cnt = empty(request()->page) ? 0 : (request()->page - 1) * 20;
                        @endphp
                        @foreach ($workShifts as $item)
                            @php
                              $cnt++;
                            @endphp
                            <tr>
                              <td>
                                <input type="checkbox" name="list_check[]" value="{{ $item->id }}">
                              </td>
                              <td>{{$cnt}}</td>
                              <td>{{$item->id}}</td>
                              <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->time_start)->format('H:i:s d/m/Y') }}</td>
                              <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->time_end)->format('H:i:s d/m/Y') }}</td>
                              <td>
                                <a href="{{Route("admin.workshift.edit", $item->id)}}" class="btn btn-info">Sửa</a>
                                <a href="{{Route("admin.workshift.delete", $item->id)}}" class="btn btn-danger">Xóa</a>
                              </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            {{ $workShifts->links() }}
        </div>
      </div>
    </div>

@endsection

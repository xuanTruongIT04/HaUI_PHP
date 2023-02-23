@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            @if (Session::has('message'))
              <div class="alert alert-warning">
                {{ Session('message') }}
              </div>
            @endif
            <div class="card-header font-weight-bold">
                Thêm tổ sản xuất
            </div>
            <div class="card-body">
                <form action="{{ Route('admin.productionTeam.store') }}" method='POST' enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="name" class="fw-550">Tên tổ sản xuất</label>
                      <input class="form-control" type="text" name="production_team_name" id="name" placeholder="Nhập tên tổ sản xuất">
                      @error('production_team_name')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror

                      <div class="form-group">
                        <label for="" class="fw-550">Mã bộ phận</label>
                        <select class="form-control" name="department_id">
                          <option value="">-------Chọn bộ phận----------</option>
                          @foreach ($listDepartment as $item)
                              <option value="{{$item->id}}">{{$item->department_name}}</option>
                          @endforeach
                        </select>
                        @error('department_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                    </div>
                    <input type="submit" name="btn_add" class="btn btn-primary" value="Thêm mới">
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Sửa thông tin tổ sản xuất
            </div>
            <div class="card-body">
                <form action="{{Route("admin.productionTeam.update", $productionTeam->id)}}" method='POST' enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="fw-550">Tên tổ sản xuất</label>
                        <input class="form-control" value="{{$productionTeam->production_team_name}}" type="text" name="production_team_name" id="production_team_name">
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="fw-550">Mã bộ phận</label>
                        <select class="form-control" name="department_id">
                          <option value="">-------Chọn bộ phận----------</option>
                          @foreach ($listDepartment as $item)
                              <option value="{{$item->id}}" @if($productionTeam->department_id == $item->id) selected = "selected" @endif>{{$item->department_name}}</option>
                          @endforeach
                        </select>
                      </div>
                    <input type="submit" name="btn_add" class="btn btn-primary" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>
@endsection

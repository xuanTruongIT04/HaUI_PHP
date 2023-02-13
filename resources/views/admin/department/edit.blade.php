@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Sửa thông tin bộ phận
            </div>
            <div class="card-body">
                <form action="{{Route("admin.department.update", $department->id)}}" method='POST' enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                    <div class="form-group">
                        <label for="name" class="fw-550">Mã bộ phận</label>
                        <input class="form-control" value="{{$department->id}}" readonly type="text" name="department_code" id="department_code">
                    </div>
                    
                    <div class="form-group">
                        <label for="name" class="fw-550">Tên bộ phận</label>
                        <input class="form-control" value="{{$department->department_name}}" type="text" name="department_name" id="department_name">
                        
                    </div>
                    <div class="form-group">
                        <label for="name" class="fw-550">Số lượng công nhân</label>
                        <input class="form-control" value="{{$department->quantity_worker}}" type="text" name="quantity_worker" id="quantity_worker">
                    </div>
                    <input type="submit" name="btn_add" class="btn btn-primary" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>
@endsection

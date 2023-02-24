@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Sửa thông tin lương
            </div>
            <div class="card-body">
                <form action="{{Route("admin.salary.update", $salary->id)}}" method='POST' enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                    <div class="form-group">
                        <label for="name" class="fw-550">Lương cơ bản</label>
                        <input class="form-control" value="{{$salary->basic_salary}}" type="text" name="basic_salary" id="">
                    </div>
                    
                    <div class="form-group">
                        <label for="name" class="fw-550">Phụ cấp</label>
                        <input class="form-control" value="{{$salary->allowance}}" type="text" name="allowance" id="">
                        
                    </div>
                    <div class="form-group">
                        <label for="name" class="fw-550">Khen thưởng</label>
                        <input class="form-control" value="{{$salary->bonus}}" type="text" name="bonus" id="">
                    </div>
                    <input type="submit" name="btn_add" class="btn btn-primary" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>
@endsection

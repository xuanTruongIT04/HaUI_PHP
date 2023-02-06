@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Sửa ca làm việc
            </div>
            <div class="card-body">
                <form action="{{Route("admin.workshift.update", $workshift->id)}}" method='POST' enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                    <div class="form-group">
                      <label for="name" class="fw-550">Mã ca làm việc</label>
                      <input class="form-control" value="{{$workshift->work_shift_code}}" type="text" name="work_shift_code" id="work_shift_code">
                    </div>
                    
                    <div class="form-group">
                      <label for="name" class="fw-550">Ngày bắt đầu</label>
                      <input class="form-control" value="{{$workshift->time_start}}" type="datetime-local" name="time_start" id="time_start">
                    </div>
                    <div class="form-group">
                      <label for="name" class="fw-550">Ngày kết thúc</label>
                      <input class="form-control" value="{{$workshift->time_end}}" type="datetime-local" name="time_end" id="time_end">
                    </div>
                    <input type="submit" name="btn_add" class="btn btn-primary" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>
@endsection

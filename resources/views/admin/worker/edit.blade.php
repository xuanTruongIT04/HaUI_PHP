@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Sửa thông tin công nhân
            </div>
            <div class="card-body">
                <form action="{{Route("admin.worker.update", $worker->id)}}" method='POST' enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="fw-550">Họ và tên</label>
                        <input class="form-control" type="text" value="{{$worker->worker_name}}" name="worker_name" id="worker_name">                        
                    </div>

                    <div class="form-group">
                        <label for="birthday" class="fw-550">Tuổi</label>
                        <input class="form-control" type="date" value="{{$worker->birthday}}" name="birthday" id="birthday">                        
                    </div>

                    <div class="form-group">
                        <label for="name" class="fw-550">Địa chỉ</label>
                        <input class="form-control" type="text" value="{{$worker->address}}" name="address" id="address">                        
                    </div>

                    <div class="form-group">
                        <label for="name" class="fw-550">Số ngày làm việc</label>
                        <input class="form-control" type="text" readonly value="{{$worker->number_of_working_days}}" name="number_of_working_days" id="">                        
                    </div>

                    <div class="form-group">
                        <label for="name" class="fw-550">Số giờ tăng ca</label>
                        <input class="form-control" type="text" readonly value="{{$worker->number_of_overtime}}" name="number_of_overtime" id="">                        
                    </div>
                    
                    <div class="form-group">
                        <label for="status" class="fw-550">Trạng thái</label>
                        <select class="form-control" name="status">
                            <option value="1">Đang làm việc</option>
                            <option value="0">Đã nghỉ việc</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="" class="fw-550">Mã lương</label>
                        <select class="form-control" name="salary_id">
                          @foreach ($listSalary as $item)
                              <option value="{{$item->id}}" @if($worker->salary_id == $item->id) selected = "selected" @endif>{{$item->id}}</option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="" class="fw-550">Mã bộ phận</label>
                        <select class="form-control" name="department_id">
                          @foreach ($listDepartment as $item)
                              <option value="{{$item->id}}" @if($worker->department_id == $item->id) selected = "selected" @endif>{{$item->department_name}}</option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="" class="fw-550">Ca làm việc</label>
                        <select class="form-control" name="work_shift_id">
                          @foreach ($listWorkShift as $item)
                              <option value="{{$item->id}}" @if($worker->work_shift_id == $item->id) selected = "selected" @endif>{{$item->id}}</option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="" class="fw-550">Tổ sản xuất</label>
                        <select class="form-control" name="production_team_id">
                          @foreach ($listDepartment as $item)
                              <option value="{{$item->id}}" @if($worker->production_team_id == $item->id) selected = "selected" @endif>{{$item->id}}</option>
                          @endforeach
                        </select>
                    </div>
                    <input type="submit" name="btn_add" class="btn btn-primary" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>
@endsection

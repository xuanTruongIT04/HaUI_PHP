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
            Thêm mới công nhân
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.worker.store') }}" method='POST' enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="fw-550">Họ và tên</label>
                    <input class="form-control" type="text" name="worker_name" id="name" placeholder="Nhập họ tên công nhân">
                    @error('worker_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <label for="old" class="fw-550">Tuổi</label>
                    <input class="form-control" type="text" name="old" id="old" placeholder="Nhập tuổi của công nhân">
                    @error('old')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <label for="address" class="fw-550">Địa chỉ</label>
                    <input class="form-control" type="text" name="address" id="address" placeholder="Nhập địa chỉ công nhân">
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <label for="number_of_working_days" class="fw-550">Số ngày làm việc</label>
                    <input class="form-control" type="text" name="number_of_working_days" id="number_of_working_days" placeholder="Nhập số ngày làm việc">
                    @error('number_of_working_days')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <label for="number_of_overtime" class="fw-550">Số giờ tăng ca</label>
                    <input class="form-control" type="text" name="number_of_overtime" id="number_of_overtime" placeholder="Nhập số giờ tăng ca">
                    @error('number_of_overtime')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <label for="status" class="fw-550">Trạng thái</label>
                    <select class="form-control" name="status">
                        <option value="">-------Chọn bộ phận----------</option>
                        <option value="1">Đang làm việc</option>
                    </select>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <div class="form-group">
                        <label for="" class="fw-550">Bộ phận</label>
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

                    <div class="form-group">
                        <label for="" class="fw-550">Tổ sản xuất</label>
                        <select class="form-control" name="production_team_id">
                            <option value="">-------Chọn tổ sản xuất----------</option>
                            @foreach ($listProductionTeam as $item)
                                <option value="{{$item->id}}">{{$item->production_team_name}}</option>
                            @endforeach
                        </select>
                        @error('production_team_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="" class="fw-550">Mã lương</label>
                        <select class="form-control" name="salary_id">
                            <option value="">-------Chọn mã lương----------</option>
                            @foreach ($listSalary as $item)
                                <option value="{{$item->id}}">{{$item->id}}</option>
                            @endforeach
                        </select>
                        @error('salary_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="" class="fw-550">Mã ca làm việc</label>
                        <select class="form-control" name="work_shift_id">
                            <option value="">-------Chọn mã ca làm việc----------</option>
                            @foreach ($listWorkShift as $item)
                                <option value="{{$item->id}}">{{$item->id}}</option>
                            @endforeach
                        </select>
                        @error('work_shift_id')
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

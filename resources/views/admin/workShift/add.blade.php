@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm ca làm việc
            </div>
            <div class="card-body">
                <form action="{{ Route('admin.workshift.store') }}" method='POST' enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="name" class="fw-550">Mã ca làm việc</label>
                      <input class="form-control" type="text" name="work_shift_code" id="name" placeholder="Nhập mã ca làm việc">
                    </div>
                    
                    <div class="form-group">
                      <label for="name" class="fw-550">Ngày bắt đầu</label>
                      <input class="form-control" type="datetime-local" name="time_start" id="name" placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                      <label for="name" class="fw-550">Ngày kết thúc</label>
                      <input class="form-control" type="datetime-local" name="time_end" id="name" placeholder="Nhập tên sản phẩm">
                    </div>
                    <input type="submit" name="btn_add" class="btn btn-primary" value="Thêm mới">
                </form>
            </div>
        </div>
    </div>
@endsection

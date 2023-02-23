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
                Thêm ca làm việc
            </div>
            <div class="card-body">
                <form action="{{ Route('admin.workshift.store') }}" method='POST' enctype="multipart/form-data">
                    @csrf
<<<<<<< HEAD
                    <div class="form-group">
                      <label for="name" class="fw-550">Ngày bắt đầu</label>
                      <input class="form-control" type="datetime-local" name="time_start" id="name" placeholder="Nhập tên sản phẩm">
                      @error('time_start')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
=======
                    <div class="form-group col-6">
                    <label for="name" class="fw-550">Ngày bắt đầu</label>
                    <input class="form-control" type="datetime-local" name="time_start" id="name" placeholder="Nhập tên sản phẩm">
                        @error('time_start')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
>>>>>>> d693082fd433130cc38eff42a34ffc475a914cd4
                    </div>
                    <div class="form-group col-6">
                        <label for="name" class="fw-550">Ngày kết thúc</label>
                        <input class="form-control" type="datetime-local" name="time_end" id="name" placeholder="Nhập tên sản phẩm">
                        @error('time_end')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="submit" name="btn_add" class="btn btn-primary" value="Thêm mới">
                </form>
            </div>
        </div>
    </div>
@endsection

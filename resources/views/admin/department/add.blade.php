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
                Thêm ca bộ phận
            </div>
            <div class="card-body">
                <form action="{{ Route('admin.department.store') }}" method='POST' enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="name" class="fw-550">Tên bộ phận</label>
                      <input class="form-control" type="text" name="department_name" id="name" placeholder="Nhập tên bộ phận">
                      @error('department_name')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <input type="submit" name="btn_add" class="btn btn-primary" value="Thêm mới">
                </form>
            </div>
        </div>
    </div>
@endsection

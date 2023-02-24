@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sửa thông tin danh mục lỗi
            </div>
            <div class="card-body">
                <form action="{{ url("admin/defectiveProduct/update/{$defectiveProduct->id}") }}" method='POST'>
                    @csrf
                    <div class="form-group">
                        <label for="name" class="fw-550">Tên danh mục lỗi</label>
                        <input class="form-control" type="text" name="name_defectiveProduct" id="name" value="{{ $defectiveProduct->name_defectiveProduct }}">
                        @error('name_defectiveProduct')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <input type="submit" name="btn_update" class="btn btn-primary" value="Thêm mới">
                </form>
            </div>
        </div>
    </div>
@endsection

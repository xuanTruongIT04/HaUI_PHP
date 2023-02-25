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
                        <input class="form-control" type="text" name="product_name" id="name"
                            value="{{ $defectiveProduct->product_name }}" readonly="readonly">
                        @error('product_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="error-reason" class="fw-550">Lí do lỗi</label>
                        <input class="form-control" type="text" name="error_reason" id="error-reason"
                            value="{{ $defectiveProduct->error_reason }}">
                        @error('error_reason')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name" class="fw-550">Tình trạng lỗi</label>
                        {!! show_defective_product_status($defectiveProduct->can_fix) !!}
                        @error('error_reason')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <input type="submit" name="btn_update" class="btn btn-primary" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sửa thông tin kế hoạch sản xuất
            </div>
            <div class="card-body">
                <form action="{{ url("admin/productionPlan/update/{$productionPlan->id}") }}" method='POST'>
                    @csrf
                    <div class="form-group">
                        <label for="name" class="fw-550">Tên kế hoạch sản xuất</label>
                        <input class="form-control" type="text" name="name_productionPlan" id="name" value="{{ $productionPlan->name_productionPlan }}">
                        @error('name_productionPlan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <input type="submit" name="btn_update" class="btn btn-primary" value="Thêm mới">
                </form>
            </div>
        </div>
    </div>
@endsection

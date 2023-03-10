@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sửa thông tin kho
            </div>
            <div class="card-body">
                <form action="{{ url("admin/warehouse/update/{$warehouse->id}") }}" method='POST'>
                    @csrf
                    <div class="form-group">
                        <label for="name" class="fw-550">Tên kho</label>
                        <input class="form-control" type="text" name="warehouse_name" value="{{ $warehouse->warehouse_name }}" id="name">
                        @error('warehouse_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="warehouse-location" class="fw-550">Vị trí kho</label>
                        <input class="form-control" type="text" name="warehouse_location" value="{{ $warehouse->warehouse_location }}" id="warehouse-location">
                        @error('warehouse_location')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <input type="submit" name="btn_update" class="btn btn-primary" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>
@endsection

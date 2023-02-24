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
                        <input class="form-control" type="text" name="production_plan_name" value="{{ $productionPlan -> production_plan_name }}" id="name">
                        @error('production_plan_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="start-date" class="fw-550">Ngày bắt đầu</label> <BR>
                        <input class="form-control w-30" type="date" name="start_date" value="{{ $productionPlan -> start_date }}" id="start-date"> <span class="date_old">Ngày bắt đầu cũ: {!! time_format($productionPlan -> start_date) !!}</span> <BR>
                        @error('start_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date-end" class="fw-550">Ngày kết thúc</label> <BR>
                        <input class="form-control w-30" type="date" name="date_end" value="{{ $productionPlan -> date_end }}" id="date-end"> <span class="date_old">Ngày kết thúc cũ: {!! time_format($productionPlan -> date_end) !!}</span> <BR>
                        @error('date_end')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <input type="submit" name="btn_update" class="btn btn-primary" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm kế hoạch sản xuất
            </div>
            <div class="card-body">
                <form action="{{ url("admin/productionPlan/store") }}" method='POST'>
                    @csrf
                    <div class="form-group">
                        <label for="name" class="fw-550">Tên kế hoạch sản xuất</label>
                        <input class="form-control" type="text" name="production_plan_name" value="{{ Old("production_plan_name") }}" id="name">
                        @error('production_plan_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="start-date" class="fw-550">Ngày bắt đầu</label> <BR>
                        <input class="form-control w-30" type="date" name="start_date" value="{{ Old("class") }}" id="start-date"> <BR>
                        @error('start_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date-end" class="fw-550">Ngày kết thúc</label> <BR>
                        <input class="form-control w-30" type="date" name="date_end" value="{{ Old("date_end") }}" id="date-end"> <BR>
                        @error('date_end')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <input type="submit" name="btn_add" class="btn btn-primary" value="Thêm mới">
                </form> 
            </div>
        </div>
    </div>
@endsection

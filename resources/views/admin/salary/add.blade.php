@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm lương
            </div>
            <div class="card-body">
                <form action="{{ Route('admin.salary.store') }}" method='POST'>
                    @csrf
                    <div class="form-group">
                        <label for="" class="fw-550">Lương cơ bản</label>
                        <input class="form-control" type="text" name="basic_salary" id="">
                        @error('basic_salary')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="" class="fw-550">Phụ cấp</label>
                        <input class="form-control" type="text" name="allowance" id="">
                        @error('allowance')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="" class="fw-550">Khen thưởng</label>
                        <input class="form-control" type="text" name="bonus" id="">
                        @error('bonus')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <input type="submit" name="btn_add" class="btn btn-primary" value="Thêm mới">
                </form> 
            </div>
        </div>
    </div>
@endsection

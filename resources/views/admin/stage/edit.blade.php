@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sửa thông tin công đoạn
            </div>
            <div class="card-body">
                <form action="{{ url("admin/stage/update/{$stage->id}") }}" method='POST'>
                    @csrf
                    <div class="form-group">
                        <label for="name" class="fw-550">Tên công đoạn</label>
                        <input class="form-control" type="text" name="stage_name" id="name" value="{{ $stage->stage_name }}">
                        @error('stage_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stage-detail" class="fw-550">Chi tiết công đoạn</label>
                        <textarea class="form-control" name="stage_detail" id="stage-detail">{{ $stage->stage_detail }}</textarea>
                        @error('stage_detail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stage-detail" class="fw-550">Thứ tự công đoạn</label>
                        <input class="form-control w-17 d-block" type="number" min="1" name="order" id="name" value="{{ $stage->order }}">
                        @error('order')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <input type="submit" name="btn_update" class="btn btn-primary" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>
@endsection

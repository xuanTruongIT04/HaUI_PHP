@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm công đoạn sản xuất
            </div>
            <div class="card-body">
                <form action="{{ url("admin/stage/store") }}" method='POST'>
                    @csrf
                    <div class="form-group">
                        <label for="name" class="fw-550">Tên công đoạn</label>
                        <input class="form-control" type="text" name="stage_name" id="name" value="{{ Old("stage_name") }}">
                        @error('stage_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stage-detail" class="fw-550">Chi tiết công đoạn</label>
                        <textarea class="form-control" name="stage_detail" id="stage-detail">{{ Old('stage_detail') }}</textarea>
                        @error('stage_detail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stage-detail" class="fw-550">Thứ tự công đoạn</label>
                        <input class="form-control w-17 d-block" type="number" name="order" min="1" id="name" value="@php if(!empty(Old("order"))) echo Old("order"); else echo "0"; @endphp">
                        @error('order')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <input type="submit" name="btn_add" class="btn btn-primary" value="Thêm mới">
                </form> 
            </div>
        </div>
    </div>
@endsection

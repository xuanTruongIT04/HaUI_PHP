@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm thiết bị sản xuất
            </div>
            <div class="card-body">
                <form action="{{ route('admin.productionEquipment.store') }}" method='POST' enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="equipment_name" class="fw-550">Tên thiết bị</label>
                        <input class="form-control" type="text" name="equipment_name" id="equipment_name" value="">
                        @error('equipment_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status" class="fw-550">Tình trạng</label>
                        <input class="form-control" type="text" name="status" id="status" value="">
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="quantity" class="fw-550">Số lượng</label>
                        <input class="form-control" type="text" name="quantity" id="quantity" value="">
                        @error('quantity')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price" class="fw-550">Giá thành</label>
                        <input class="form-control" type="text" name="price" id="price" value="">
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="output_time" class="fw-550">Thời gian sản xuất</label>
                        <input class="form-control" type="date" name="output_time" id="output_time" value="">
                        @error('output_time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="maintenance_time" class="fw-550">Thời gian bảo dưỡng</label>
                        <input class="form-control" type="date" name="maintenance_time" id="maintenance_time" value="">
                        @error('maintenance_time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="specifications" class="fw-550">Thông số kỹ thuật</label>
                        <input class="form-control" type="text" name="specifications" id="specifications" value="">
                        @error('specifications')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="describe" class="fw-550">Mô tả</label>
                        <input class="form-control" type="text" name="describe" id="describe" value="">
                        @error('describe')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="production_team_id" class="fw-550">Mã tổ sản xuất</label>
                        <select class="form-control" name="production_team_id">
                            <option value="">-------Chọn tổ sản xuất----------</option>
                            @foreach ($productionTeams as $item)
                                <option value="{{$item->id}}">{{$item->production_team_name}}</option>
                            @endforeach
                          </select>
                        @error('production_team_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="submit" name="btn_add" class="btn btn-primary" value="Thêm mới">
                </form>
            </div>
        </div>
    </div>
@endsection

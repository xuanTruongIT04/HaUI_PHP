@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Sửa thông tin thiết bị sản xuất
            </div>
            <div class="card-body">
                <form action="{{Route("admin.productionEquipment.update", $productionEquipment->id)}}" method='POST' enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="" class="fw-550">Tên thiết bị</label>
                        <input class="form-control" value="{{$productionEquipment->equipment_name}}" type="text" name="equipment_name" id="">
                    </div>

                    <div class="form-group">
                        <label for="" class="fw-550">Tình trạng</label>
                        <input class="form-control" value="{{$productionEquipment->status}}" type="text" name="status" id="">
                    </div>

                    <div class="form-group">
                        <label for="" class="fw-550">Số lượng</label>
                        <input class="form-control" value="{{$productionEquipment->quantity}}" type="text" name="quantity" id="">
                    </div>

                    <div class="form-group">
                        <label for="" class="fw-550">Giá thành</label>
                        <input class="form-control" value="{{$productionEquipment->price}}" type="text" name="price" id="">
                    </div>

                    <div class="form-group">
                        <label for="" class="fw-550">Thời gian sản xuất</label>
                        <input class="form-control" value="{{$productionEquipment->output_time}}" type="text" name="output_time" id="">
                    </div>

                    <div class="form-group">
                        <label for="" class="fw-550">Thời gian bảo dưỡng</label>
                        <input class="form-control" value="{{$productionEquipment->maintenance_time}}" type="text" name="maintenance_time" id="">
                    </div>

                    <div class="form-group">
                        <label for="" class="fw-550">Thông số kỹ thuật</label>
                        <input class="form-control" value="{{$productionEquipment->specifications}}" type="text" name="specifications" id="">
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="fw-550">Mã tổ</label>
                        <select class="form-control" name="describe">
                          <option value="">-------Chọn tổ sản xuất----------</option>
                          @foreach ($listProductionTeam as $item)
                              <option value="{{$item->id}}" @if($productionEquipment->production_team_id == $item->id) selected = "selected" @endif>{{$item->production_team_name}}</option>
                          @endforeach
                        </select>
                      </div>
                    <input type="submit" name="btn_add" class="btn btn-primary" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>
@endsection

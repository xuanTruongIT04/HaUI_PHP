@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sửa thông tin vật tư
            </div>
            <div class="card-body">
                <form id="form-upload" action="{{ url("admin/material/update/{$material->id}") }}" method='POST'
                    enctype="multipart/form-data">
                    @csrf
                    {{--  protected $fillable = ['material_name', 'material_desc', 'qty_import', 'qty_broken', 'qty_remain',
                    'price_import', 'date_import', 'unit_of_measure', 'material_status', 'stage_id', 'image_id']; --}}

                    <div class="form-group">
                        <label for="name" class="fw-550">Tên vật tư</label>
                        <input class="form-control" type="text" name="material_name" id="name"
                            value="{{ $material->material_name }}">
                        @error('material_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="material-desc" class="fw-550">Mô tả vật tư</label>
                        <textarea class="form-control" name="material_desc" id="material-desc">{{ $material->material_desc }}</textarea>
                        @error('material_desc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for='material_thumb' class="fw-550">Hình ảnh chính của vật tư</label> <BR>
                        <div id="uploadFile">
                            <input type="file" name="material_thumb" class="form-control-file upload_file"
                                onchange="upload_image(this)">
                            <img src="@if (!empty(get_main_image_material($material->id))) {{ url(get_main_image_material($material->id)) }}@else{{ url('public/uploads/img-product2.png') }} @endif" id="image_upload_file" class="mt-3">
                        </div>

                        @error('material_thumb')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="unit" class="fw-550">Đơn vị quy đổi của vật tư</label><BR>
                        <input class="form-control w-17" type="text" name="unit_of_measure"
                            placeholder="Có thể là kg/lit/cái/mét..." id="unit"
                            value="{{ $material->unit_of_measure }}"> <BR>
                        @error('unit_of_measure')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price-import" class="fw-550">Giá nhập vật tư</label> <BR>
                        <input class="form-control w-30" type="text" name="price_import" id="price-import"
                            value="{{ $material->price_import }}"> <span class="ml-3">VNĐ</span> <BR>
                        @error('price_import')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date-import" class="fw-550">Ngày nhập</label><BR>
                        <input class="form-control w-30" type="date" name="date_import"
                            value="{{ $material->date_import }}" id="date-import">  <span class="date_old">Ngày nhập cũ: {!! time_format($material ->date_import) !!}</span> <BR>
                        @error('date_import')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="qty-import" class="fw-550">Số lượng nhập</label> <BR>
                        <input class="form-control w-10" type="number" min="0"
                            value="@php if(!empty($material ->qty_import)) echo $material ->qty_import; else echo "0"; @endphp"
                            name="qty_import" id="qty-import">
                        @error('qty_import')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="qty-remain" class="fw-550">Số lượng hỏng</label> <BR>
                        <input class="form-control w-10" type="number" min="0"
                            value="@php if(!empty($material ->qty_broken)) echo $material ->qty_broken; else echo "0"; @endphp"
                            name="qty_broken" id="qty-remain">
                        @error('qty_broken')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="material-status" class="fw-550">Trạng thái vật tư</label> <BR>
                        {!! template_update_status_material($material->material_status) !!}
                        @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>



                    <input type="submit" name="btn_update" class="btn btn-primary mt-4" value="Cập nhật">
            </div>

            </form>
        </div>
    </div>
    </div>
@endsection

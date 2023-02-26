    @extends('layouts.admin')
    @section('content')
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm vật tư
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/material/store') }}" method='POST' enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="fw-550">Tên vật tư</label>
                            <input class="form-control" type="text" name="material_name" id="name"
                                value="{{ Old('material_name') }}">
                            @error('material_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="material-desc" class="fw-550">Mô tả vật tư</label>
                            <textarea class="form-control" name="material_desc" id="material-desc">{{ Old('material_desc') }}</textarea>
                            @error('material_desc')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for='material_thumb' class="fw-550">Hình ảnh chính của vật tư</label> <BR>
                            <div id="uploadFile">
                                <input type="file" name="material_thumb" class="form-control-file upload_file"
                                    onchange="upload_image(this)">
                                <img src={{ url('public/uploads/img-product1.png') }} id="image_upload_file" class="mt-3">
                            </div>

                            @error('material_thumb')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="unit" class="fw-550">Đơn vị quy đổi của vật tư</label><BR>
                            <input class="form-control w-17" type="text" name="unit_of_measure" placeholder="Có thể là kg/lit/cái/mét..." id="unit"
                                value="{{ Old('unit_of_measure') }}"> <BR>
                            @error('unit_of_measure')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price-import" class="fw-550">Giá nhập vật tư</label> <BR>
                            <input class="form-control w-30" type="text" name="price_import" id="price-import"
                                value="{{ Old('price_import') }}"> <span class="ml-3">VNĐ</span> <BR>
                            @error('price_import')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date-import" class="fw-550">Ngày nhập</label> <BR>
                            <input class="form-control w-30" type="date" name="date_import" value="{{ Old("date_import") }}" id="date-import"> <BR>
                            @error('date_import')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="qty-import" class="fw-550">Số lượng nhập</label> <BR>
                            <input class="form-control w-10" type="number" min="0" value="@php if(!empty(Old("qty_import"))) echo Old("qty_import"); else echo "0"; @endphp" name="qty_import"
                                id="qty-import">
                            @error('qty_import')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="qty-remain" class="fw-550">Số lượng hỏng</label> <BR>
                            <input class="form-control w-10" type="number" min="0" value="@php if(!empty(Old("qty_broken"))) echo Old("qty_broken"); else echo "0"; @endphp" name="qty_broken"
                                id="qty-remain">
                            @error('qty_broken')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <input type="submit" name="btn_add" class="btn btn-primary" value="Thêm mới">
                    </form>
                </div>
            </div>
        </div>
    @endsection

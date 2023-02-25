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
                            <label for="slug" class="fw-550">Slug (Friendly Url)</label>
                            <input class="form-control" type="text" name="slug" id="slug"
                                value="{{ Old('slug') }}">
                            @error('slug')
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
                            <label for="material-detail" class="fw-550">Chi tiết vật tư</label>
                            <textarea class="form-control" name="material_detail" id="material-detail">{{ Old('material_detail') }}</textarea>
                            @error('material_detail')
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
                        {{-- Danh mục vật tư --}}
                        <div class="form-group w-30">
                            <label for="material_cat" class="fw-550">Danh mục</label>

                            @if (!empty($list_material_cat))
                                <select name="material_cat" id="material_cat" class="form-control">
                                    <option value="">-- Chọn danh mục --</option>
                                    @foreach ($list_material_cat as $material_cat)
                                        @php
                                            $sel = '';
                                        @endphp
                                        @php
                                            if ($material_cat->id == Old('material_cat')) {
                                                $sel = "selected='selected'";
                                            }
                                        @endphp
                                        <option value="{{ $material_cat->id }}" {{ $sel }}>
                                            {{ str_repeat('-', $material_cat->level) . ' ' . $material_cat->material_cat_title }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <p class="empty-task">Không tồn tại danh mục nào</p>
                            @endif
                            @error('material_cat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price-old" class="fw-550">Giá vật tư</label> <BR>
                            <input class="form-control w-30" type="text" name="price_old" id="price-old"
                                value="{{ Old('price_old') }}"> <span class="ml-3">VNĐ</span> <BR>
                            @error('price_old')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="qty-remain" class="fw-550">Số lượng kho</label> <BR>
                            <input class="form-control w-10" type="number" min="0" value="empty(Old('qty_remain')){{ 0 }}" name="qty_remain"
                                id="qty-remain"> <BR>
                            @error('qty_remain')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <input type="submit" name="btn_add" class="btn btn-primary" value="Thêm mới">
                    </form>
                </div>
            </div>
        </div>
    @endsection

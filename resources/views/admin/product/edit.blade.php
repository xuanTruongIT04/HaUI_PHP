@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sửa thông tin trang
            </div>
            <div class="card-body">
                <form id="form-upload" action="{{ url("admin/product/update/{$product->id}") }}" method='POST'
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="code" class="fw-550">Mã sản phẩm</label>
                        <input class="form-control no-edit" type="text" readonly="readonly" name="product_code" id="code"
                            value="{{ $product->product_code }}">
                        @error('product_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name" class="fw-550">Tên sản phẩm</label>
                        <input class="form-control" type="text" name="product_name" id="name"
                            value="{{ $product->product_name }}">
                        @error('product_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="product-desc" class="fw-550">Mô tả sản phẩm</label>
                        <textarea class="form-control" name="product_desc" id="product-desc">{{ $product->product_desc }}</textarea>
                        @error('product_desc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product-detail" class="fw-550">Chi tiết sản phẩm</label>
                        <textarea class="form-control" name="product_detail" id="product-detail">{{ $product->product_detail }}</textarea>
                        @error('product_detail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for='product-thumb' class="fw-550">Hình ảnh chính của sản phẩm</label> <BR>
                        <div id="uploadFile">
                            <input type="file" name="product_thumb" id="product-thumb" class="form-control-file upload_file"
                                onchange="upload_image(this)">
                            <img src="@if (!empty(get_main_image($product->id))) {{ url(get_main_image($product->id)) }}@else{{ url('public/uploads/img-product2.png') }} @endif"
                                alt="Ảnh của sản phẩm {{ $product->product_name }}"
                                title="Ảnh của sản phẩm {{ $product->product_name }}" id="image_upload_file"
                                class="mt-3">
                        </div>

                        @error('product_thumb')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price-old" class="fw-550">Giá sản phẩm (cũ)</label> <BR>
                        <input class="form-control w-30" type="text" name="price_old" id="price-old"
                            value="{{ $product->price_old }}"> <span class="ml-3">VNĐ</span> <BR>
                        @error('price_old')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price-new" class="fw-550">Giá sản phẩm (mới)</label> <BR>
                        <input class="form-control w-30" type="text" name="price_new" id="price-new"
                            value="{{ $product->price_new }}"> <span class="ml-3">VNĐ</span> <BR>
                        @error('price_new')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="qty-sold" class="fw-550">Số lượng đã bán</label>
                        <input class="form-control w-10" type="number" min="0" name="qty_sold" id="qty-sold"
                            value="{{ $product->qty_sold }}">
                        @error('qty_sold')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="qty-broken" class="fw-550">Số lượng hỏng</label>
                        <input class="form-control w-10" type="number" min="0" name="qty_broken" id="qty-broken"
                            value="{{ $qty_broken }}">
                        @error('qty_broken')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="qty-remain" class="fw-550">Số lượng kho</label>
                        <input class="form-control w-10" type="number" min="0" name="qty_remain" id="qty-remain"
                            value="{{ $product->qty_remain }}">
                        @error('qty_remain')
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

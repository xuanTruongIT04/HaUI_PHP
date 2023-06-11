    @extends('layouts.admin')
    @section('content')
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm sản phẩm
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/product/store') }}" method='POST' enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="fw-550">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="product_name" id="name"
                                value="{{ Old('product_name') }}">
                            @error('product_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="product-desc" class="fw-550">Mô tả sản phẩm</label>
                            <textarea class="form-control" name="product_desc" id="product-desc">{{ Old('product_desc') }}</textarea>
                            @error('product_desc')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="product-detail" class="fw-550">Chi tiết sản phẩm</label>
                            <textarea class="form-control" name="product_detail" id="product-detail">{{ Old('product_detail') }}</textarea>
                            @error('product_detail')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for='product_thumb' class="fw-550">Hình ảnh chính của sản phẩm</label> <BR>
                            <div id="uploadFile">
                                <input type="file" name="product_thumb" class="form-control-file upload_file"
                                    onchange="upload_image(this)">
                                <img src={{ url('public/uploads/img-product1.png') }} id="image_upload_file" class="mt-3">
                            </div>

                            @error('product_thumb')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price-old" class="fw-550">Giá sản phẩm</label> <BR>
                            <input class="form-control w-30" type="text" name="price_old" id="price-old"
                                value="{{ Old('price_old') }}"> <span class="ml-3">VNĐ</span> <BR>
                            @error('price_old')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="qty-remain" class="fw-550">Số lượng kho</label> <BR>
                            <input class="form-control w-10" type="number" min="0" value="empty(Old('qty_remain')){{ 0 }}" name="qty_remain"
                                id="qty-remain">
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

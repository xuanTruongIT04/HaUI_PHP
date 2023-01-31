@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card-header font-weight-bold">
                Thêm nhiều hình ảnh
            </div>
            <div class="card-body">
                @php
                    $id = request()->id;
                @endphp
                <form action="{{ url("admin/image/storeMulti/$id") }}" method='POST' enctype="multipart/form-data">
                    @csrf

                    <div class="upload__box">
                        <div class="upload__btn-box">
                            <span>
                                <h6>Ảnh chính của sản phẩm tên: <b>{{ $product_name }}</b></h6>
                                <img src="{{ url($link_img_main) }}" alt="Ảnh chính của sản phẩm tên: <b>{{ $product_name }}</b>" style="max-width: 250px; height: auto;">
                            </span>
                            <h6>Danh sách hình ảnh</h6>
                            <label class="upload__btn">
                                <span>Chọn nhiều tệp</span>
                                <input type="file" multiple="" data-max_length="20" class="upload__inputfile"
                                    name="image_link[]">
                            </label>
                            <div class="thumbnail-multiple" id="cover-img-upload-mutiple">
                                <img src={{ url('public/uploads/img-product1.png') }} id="img-upload-mutiple"
                                    class="mt-2 mb-2 img-thumbnail">
                            </div>
                            @error('image_link')
                                <small style="display:block;" class="text-danger">{{ $message }}</small>
                            @enderror
                            @error('image_link.*')
                                <small style="display:block;" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="upload__img-wrap"></div>
                    </div>

                    <input type="submit" name="btn_add" class="btn btn-primary" value="Thêm mới">
                </form>
            </div>
        </div>
    </div>
@endsection

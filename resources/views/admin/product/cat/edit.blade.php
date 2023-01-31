@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sửa thông tin danh mục sản phẩm
            </div>
            <div class="card-body">
                <form id="form-upload" action="{{ url("admin/product/cat/update/{$product_cat->id}") }}" method='POST'
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="fw-550">Tiêu đề</label>
                        <input class="form-control" type="text" name="product_cat_title" id="name"
                            value="{{ $product_cat->product_cat_title }}">
                        @error('product_cat_title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="slug" class="fw-550">Slug (Friendly Url)</label>
                        <input class="form-control" type="text" name="slug" id="slug"
                            value="{{ $product_cat->slug }}">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="level" class="fw-550">Cấp độ danh mục</label>
                        <input type="number" name="level" id="level" style="background: #FFF; cursor: default;"
                            class="form-control" min="0" max="100" value="{{ $product_cat->level }}">
                        @error('level')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Danh mục sản phẩm cha --}}
                    <div class="form-group">
                        <label for="cat_parent" class="fw-550">Danh mục cha</label>
                        @if (!empty($list_product_cat))
                            <select name="cat_parent" id="cat_parent" class="form-control">
                                <option value="">-- Chọn danh mục --</option>
                                <option value="-1" style="font-style: italic;">Không có danh mục cha</option>
                                @foreach ($list_product_cat as $product_cat_parent)
                                    @php
                                        $sel = '';
                                    @endphp
                                    @if ($product_cat->cat_parent_id == $product_cat_parent->id)
                                        @php
                                            $sel = "selected = 'seleceted'";
                                        @endphp
                                    @endif
                                    <option value="{{ $product_cat_parent->id }}" {{ $sel }}>
                                        {{ str_repeat('-', $product_cat_parent->level) . ' ' . $product_cat_parent->product_cat_title }}
                                    </option>   
                                @endforeach
                            </select>
                        @else
                            <p class="empty-task">Không tồn tại danh mục nào</p>
                        @endif
                        @error('cat_parent')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status" class="fw-550">Trạng thái</label>

                        @if (!empty($product_cat->product_cat_status))
                            {!! template_update_status($product_cat->product_cat_status) !!}
                        @endif

                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <input type="submit" name="btn_update" class="btn btn-primary mt-4" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>
@endsection

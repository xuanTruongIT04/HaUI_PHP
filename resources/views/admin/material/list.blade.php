@extends('layouts.admin')


@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <div id="title-btn-add">
                    <h5 class="m-0 ">Danh sách vật tư</h5>
                    <a href="{{ route('admin.material.add') }}" class="btn btn-primary ml-3">THÊM MỚI</a>
                </div>
                <div class="form-search form-inline">
                    <form action="#" method="GET">
                        @csrf
                        <input type="text" class="form-control form-search" name="key_word"
                            value="{{ request()->input('key_word') }}" placeholder="Tìm kiếm">
                        <input type="submit" name="btn_search" value="Tìm kiếm" class="btn btn-primary">
                        <input type="hidden" name="status"
                            value="{{ empty(request()->input('status')) ? 'active' : request()->input('status') }}" />
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="text-primary">Kích
                        hoạt<span class="text-muted">({{ $count_material_status[0] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'pass_test']) }}" class="text-primary">Đã kiểm tra
                        <span class="text-muted">({{ $count_material_status[1] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'testing']) }}" class="text-primary">Chưa kiểm tra
                        <span class="text-muted">({{ $count_material_status[2] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trashed']) }}" class="text-primary">Vô hiệu
                        hoá<span class="text-muted">({{ $count_material_status[3] }})</span></a>
                </div>
                <form action="{{ url('admin/material/action') }}" method="GET">
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" name="act" id="">
                            <option value="">Chọn</option>
                            @foreach ($list_act as $k => $act)
                                <option value="{{ $k }}">{{ $act }}</option>
                            @endforeach
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div>
                    @if (!empty(request()->key_word))
                        <div class="count-material"><span>Kết quả tìm kiếm: <b>{{ $count_material }}</b> vật tư</span>
                        </div>
                    @endif
                   
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkAll">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Tên vật tư</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Đơn vị quy đổi</th>
                                <th scope="col">Giá nhập</th>
                                <th scope="col">Ngày nhập</th>
                                <th scope="col">Số lượng nhập</th>
                                <th scope="col">Số lượng hỏng</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($count_material > 0)
                                @php
                                    $cnt = empty(request()->page) ? 0 : (request()->page - 1) * 20;
                                @endphp
                                @foreach ($materials as $material)
                                    @php
                                        $cnt++;
                                    @endphp
                                    <tr class="row-in-list">
                                        <td>
                                            <input type="checkbox" name="list_check[]" value="{{ $material->id }}"">
                                        </td>
                                        <th scope=" row">{{ $cnt }}</th>
                                        <td><a
                                                href="{{ route('admin.material.edit', $material->id) }}">{{ $material->material_name }}</a>
                                        </td>
                                        @if (request()->status != 'trashed')
                                            <td>
                                                <div class=" product_thumb_main">
                                                    <a href="{{ route('admin.material.edit', $material->id) }}"
                                                        class="thumbnail">
                                                        <img src="@if (!empty(get_main_image_material($material->id))) {{ url(get_main_image_material($material->id)) }}@else{{ url('public/uploads/img-product2.png') }} @endif"
                                                            alt="Ảnh của sản phẩm {{ $material->material_name }}"
                                                            title="Ảnh của sản phẩm {{ $material->material_name }}"
                                                            id="thumbnail_img">
                                                    </a>
                                                    <a class="cover-bonus-product-thumb"
                                                        href="{{ route('admin.image.addMulti', $material->id) }}">
                                                        <img src="{{ url('public/uploads/hinhdaucong.png') }}"
                                                            alt="" class="thumbnail_img bonus_product_thumb">
                                                    </a>
                                                </div>
                                            </td>
                                        @else
                                            <td>
                                                <div href="{{ route('admin.material.edit', $material->id) }}"
                                                    class="thumbnail">
                                                    <img src="@if (!empty(get_main_image_material($material->id))) {{ url(get_main_image_material($material->id)) }}@else{{ url('public/uploads/img-product2.png') }} @endif"
                                                        alt="Ảnh của sản phẩm {{ $material->material_name }}"
                                                        title="Ảnh của sản phẩm {{ $material->material_name }}"
                                                        id="thumbnail_img">
                                                </div>
                                            </td>
                                        @endif
                                        <td>{{ $material->unit_of_measure }}</td>
                                        <td>{{ currency_format($material->price_import) }}</td>
                                        <td>{{ time_format($material->date_import) }}</td>
                                        <td>{{ $material->qty_import }}</td>
                                        <td>{{ $material->qty_broken }}</td>
                                        <td>{!! field_status_material($material->material_status) !!}</td>
                                        @if (request()->status != 'trashed')
                                            <td>
                                                <a href="{{ route('admin.material.edit', $material->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                                {{-- <a href="{{ route('admin.material.delete', $material->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xoá vật tư {{ $material->material_name }}?')"
                                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></a> --}}
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ route('admin.material.restore', $material->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip"
                                                    onclick="return confirm('Bạn có chắc chắn muốn khôi phục vật tư {{ $material->material_name }}?')"
                                                    data-placement="top" title="Restore"><i
                                                        class="fas fa-trash-restore-alt"></i></a>
                                                {{-- <a href="{{ route('admin.material.delete', $material->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xoá vĩnh viễn vật tư {{ $material->material_name }}?')"
                                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></a> --}}
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="bg-white">Không tìm thấy vật tư nào!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                {{ $materials->links() }}
            </div>
        </div>
    </div>

@endsection

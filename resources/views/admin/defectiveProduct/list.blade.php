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
                    <h5 class="m-0 ">Danh sách danh mục lỗi</h5>
                </div>
                <div class="form-search form-inline">
                    <form action="#" method="">
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
                        hoạt<span class="text-muted">({{ $count_defectiveProduct_status[0] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trashed']) }}" class="text-primary">Vô hiệu
                        hoá<span class="text-muted">({{ $count_defectiveProduct_status[1] }})</span></a>
                </div>
                <form action="{{ url('admin/defectiveProduct/action') }}" method="GET">
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
                        <div class="count-user"><span>Kết quả tìm kiếm: <b>{{ $count_defectiveProduct }}</b> danh mục lỗi</span></div>
                    @endif
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkAll">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục lỗi</th>
                                <th scope="col">Thời gian lỗi</th>
                                <th scope="col">Lí do lỗi</th>
                                <th scope="col">Tình trạng</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($count_defectiveProduct > 0)
                                @php
                                    $cnt = empty(request() -> page) ? 0 : (request() -> page - 1) * 20;
                                @endphp
                                @foreach ($defectiveProducts as $defectiveProduct)
                                    @php
                                        $cnt++;
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="list_check[]" value="{{ $defectiveProduct->id }}"">
                                        </td>
                                        <th scope=" row">{{ $cnt }}</th>
                                        <td><a class="text-primary"
                                                href="{{ route('admin.defectiveProduct.edit', $defectiveProduct->id) }}">{!! brief_name($defectiveProduct->product_name, 7) !!}</a>
                                        </td>
                                        <td>{!! time_format($defectiveProduct->error_time) !!}</td>
                                        <td>{{ $defectiveProduct->error_reason }}</td>
                                        <td>{!! set_status_defective_product($defectiveProduct->can_fix) !!}</td>
                                        @if (request()->status != 'trashed')
                                            <td>
                                                <a href="{{ route('admin.defectiveProduct.edit', $defectiveProduct->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="{{ route('admin.defectiveProduct.delete', $defectiveProduct->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xoá danh mục lỗi {{ $defectiveProduct->name_defectiveProduct }}?')"
                                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ route('admin.defectiveProduct.restore', $defectiveProduct->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip"
                                                    onclick="return confirm('Bạn có chắc chắn muốn khôi phục danh mục lỗi {{ $defectiveProduct->name_defectiveProduct }}?')"
                                                    data-placement="top" title="Restore"><i
                                                        class="fas fa-trash-restore-alt"></i></a>
                                                <a href="{{ route('admin.defectiveProduct.delete', $defectiveProduct->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xoá vĩnh viễn danh mục lỗi {{ $defectiveProduct->name_defectiveProduct }}?')"
                                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="bg-white">Không tìm thấy danh mục lỗi nào!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                {{ $defectiveProducts->links() }}
            </div>
        </div>
    </div>

@endsection

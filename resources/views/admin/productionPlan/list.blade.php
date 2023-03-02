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
                    <h5 class="m-0 ">Danh sách kế hoạch sản xuất</h5>
                    <a href="{{ route("admin.productionPlan.add") }}" class="btn btn-primary ml-3">THÊM MỚI</a>
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
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="text-primary">Triển khai<span class="text-muted">({{ $count_productionPlan_status[0] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trashed']) }}" class="text-primary">Huỷ bỏ<span class="text-muted">({{ $count_productionPlan_status[1] }})</span></a>
                </div>
                <form action="{{ url('admin/productionPlan/action') }}" method="GET">
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
                        <div class="count-user"><span>Kết quả tìm kiếm: <b>{{ $count_productionPlan }}</b> kế hoạch sản xuất</span></div>
                    @endif
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkAll">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Tên kế hoạch sản xuất</th>
                                <th scope="col">Ngày bắt đầu</th>
                                <th scope="col">Ngày kết thúc</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($count_productionPlan > 0)
                                @php
                                    $cnt = empty(request() -> page) ? 0 : (request() -> page - 1) * 20;
                                @endphp
                                @foreach ($productionPlans as $productionPlan)
                                    @php
                                        $cnt++;
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="list_check[]" value="{{ $productionPlan->id }}"">
                                        </td>
                                        <th scope=" row">{{ $cnt }}</th>
                                        <td><a class="text-primary"
                                                href="{{ route('admin.productionPlan.edit', $productionPlan->id) }}">{{ $productionPlan->production_plan_name }}</a>
                                        </td>
                                       
                                        <td>{!! time_format($productionPlan -> start_date) !!}</td>
                                        <td>{!! time_format($productionPlan -> date_end) !!}</td>
                                        @if (request()->status != 'trashed')
                                            <td>
                                                <a href="{{ route('admin.productionPlan.edit', $productionPlan->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="{{ route('admin.productionPlan.delete', $productionPlan->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip"
                                                    onclick="return confirm('Bạn có chắc chắn muốn huỷ kế hoạch sản xuất {{ $productionPlan->production_plan_name }}?')"
                                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ route('admin.productionPlan.restore', $productionPlan->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip"
                                                    onclick="return confirm('Bạn có chắc chắn muốn khôi phục kế hoạch sản xuất {{ $productionPlan->production_plan_name }}?')"
                                                    data-placement="top" title="Restore"><i
                                                        class="fas fa-trash-restore-alt"></i></a>
                                                <a href="{{ route('admin.productionPlan.delete', $productionPlan->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xoá vĩnh viễn kế hoạch sản xuất {{ $productionPlan->production_plan_name }}?')"
                                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="bg-white">Không tìm thấy kế hoạch sản xuất nào!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                {{ $productionPlans->links() }}
            </div>
        </div>
    </div>

@endsection

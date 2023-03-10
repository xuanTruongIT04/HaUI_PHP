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
                    <h5 class="m-0 ">Danh sách quản trị viên</h5>
                    <a href="{{ route("admin.user.add") }}" class="btn btn-primary ml-3">THÊM MỚI</a>
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
                        hoạt<span class="text-muted">({{ $count_user_status[0] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'licensed']) }}" class="text-primary">Đã cấp quyền
                        <span class="text-muted">({{ $count_user_status[1] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}" class="text-primary">Chờ xét duyệt
                        <span class="text-muted">({{ $count_user_status[2] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trashed']) }}" class="text-primary">Vô hiệu
                        hoá<span class="text-muted">({{ $count_user_status[3] }})</span></a>
                </div>
                <form action="{{ url('admin/user/action') }}" method="GET">
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
                        <div class="count-user"><span>Kết quả tìm kiếm: <b>{{ $count_user }}</b> thành viên</span></div>
                    @endif
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkAll">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Ảnh đại diện</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quyền</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($count_user > 0)
                                @php
                                    $cnt = empty(request() -> page) ? 0 : (request() -> page - 1) * 20;
                                @endphp
                                @foreach ($users as $user)
                                    @php
                                        $cnt++;
                                    @endphp
                                    <tr class="row-in-list">
                                        <td>
                                            <input type="checkbox" name="list_check[]" value="{{ $user->id }}"">
                                        </td>
                                        <th scope=" row">{{ $cnt }}</th>
                                        @if (request()->status != 'trashed')
                                            <td><a href="{{ route('admin.user.edit', $user->id) }}" class="thumbnail">
                                                    <img src="@if (!empty($user->image->image_link)) {{ url($user->image->image_link) }}@else{{ url('public/uploads/img-product2.png') }} @endif"
                                                        alt="Ảnh đại diện của {{ $user->fullname }}"
                                                        title="Ảnh đại diện của {{ $user->fullname }}"
                                                        id="thumbnail_img"></a>
                                            </td>
                                        @else
                                            <td>
                                                <div href="{{ route('admin.user.edit', $user->id) }}" class="thumbnail">
                                                    <img src="@if (!empty($user->image->image_link)) {{ url($user->image->image_link) }}@else{{ url('public/uploads/img-product2.png') }} @endif"
                                                        alt="Ảnh đại diện của {{ $user->fullname }}"
                                                        title="Ảnh đại diện của {{ $user->fullname }}" id="thumbnail_img">
                                                </div>
                                            </td>
                                        @endif

                                        <td>{{ $user->fullname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{!! !empty($user->role->name_role)
                                            ? $user->role->name_role
                                            : "<u class='text-danger font-italic'>Chưa cấp quyền</u>" !!}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{!! field_status_user($user->user_status) !!}</td>
                                        @if (request()->status != 'trashed')
                                            <td>
                                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                                @if (Auth::id() != $user->id)
                                                    <a href="{{ route('admin.user.delete', $user->id) }}"
                                                        class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                        data-toggle="tooltip"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xoá thành viên {{ $user->fullname }}?')"
                                                        data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                                @endif
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ route('admin.user.restore', $user->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip"
                                                    onclick="return confirm('Bạn có chắc chắn muốn khôi phục thành viên {{ $user->fullname }}?')"
                                                    data-placement="top" title="Restore"><i
                                                        class="fas fa-trash-restore-alt"></i></a>
                                                @if (Auth::id() != $user->id)
                                                    <a href="{{ route('admin.user.delete', $user->id) }}"
                                                        class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                        data-toggle="tooltip"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xoá vĩnh viễn thành viên {{ $user->fullname }}?')"
                                                        data-placement="top" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                @endif
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="bg-white">Không tìm thấy thành viên nào!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                {{ $users->links() }}
            </div>
        </div>
    </div>

@endsection

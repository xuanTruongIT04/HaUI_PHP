    @extends('layouts.admin')
    {{-- NGuyeenx vawn tho --}}

    @section('content')
    <div id="content" class="container-fluid">
    <div class="card">
        @if (Session::has('message'))
            <div class="alert alert-success">
            {{ Session('message') }}
            </div>
        @endif

        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <div id="title-btn-add">
                <h5 class="m-0 ">Bảng lương</h5>
                <a href="{{ Route("admin.salary.add") }}" class="btn btn-primary ml-3">THÊM MỚI</a>
            </div>

            <div class="form-search form-inline">
                <form action="#" method="GET">
                    @csrf
                    <input type="text" class="form-control form-search" name="key_word"
                        value="{{ request()->input('key_word') }}" placeholder="Tìm kiếm theo mã lương">
                    <input type="submit" name="btn_search" value="Tìm kiếm" class="btn btn-primary">
                    <input type="hidden" name="status"
                        value="{{ empty(request()->input('status')) ? 'active' : request()->input('status') }}" 
                    />
                </form>
            </div>
        </div>
        <div class="card-body">
            <form action="" method="GET">
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" name="filter" id="">
                        <option value="">Chọn</option>
                        <option value="1">Dưới 1,000,000</option>
                        <option value="2">Từ 1,000,000 đến 3,000,000</option>
                        <option value="3">Từ 3,000,000 đến 5,000,000</option>
                        <option value="4">Từ 5,000,000 đến 10,000,000</option>
                        <option value="5">Trên 10,000,000</option>
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                        <th>
                            <input type="checkbox" name="checkAll">
                        </th>
                        <th scope="col">STT</th>
                        <th scope="col">Lương cơ bản</th>
                        <th scope="col">Phụ cấp</th>
                        <th scope="col">Khen thưởng</th>
                        <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cnt = empty(request()->page) ? 0 : (request()->page - 1) * 20;
                        @endphp
                        @foreach ($salaries as $item)
                            @php
                                $cnt++;
                            @endphp
                            <tr>
                                <td>
                                <input type="checkbox" name="list_check[]" value="{{ $item->id }}">
                                </td>
                                <td>{{$cnt}}</td>
                                <td>{{number_format($item->basic_salary)}} VND</td>
                                <td>{{number_format($item->allowance)}} VND</td>
                                <td>{{number_format($item->bonus)}} VND</td>

                                <td>
                                    <a href="{{Route("admin.salary.edit", $item->id)}}" class="btn btn-info">Sửa</a>
                                    <a href="{{Route("admin.salary.delete", $item->id)}}" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            {{ $salaries->links() }}
        </div>
        </div>
    </div>

    @endsection

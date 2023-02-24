@extends('layouts.admin')


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
                <h5 class="m-0 ">Danh sách bộ phận</h5>
                <a href="{{ Route("admin.department.add") }}" class="btn btn-primary ml-3">THÊM MỚI</a>
            </div>
        </div>
        <div class="card-body">
            <form action="" method="GET">
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkAll">
                            </th>
                            <th scope="col">STT</th>
                            <th scope="col">Tên bộ phận</th>
                            <th scope="col">Số lượng công nhân</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $cnt = empty(request()->page) ? 0 : (request()->page - 1) * 20;
                        @endphp
                        @foreach ($department as $item)
                            @php
                            $cnt++;
                            @endphp
                            <tr>
                                <td>
                                    <input type="checkbox" name="list_check[]" value="{{ $item->id }}">
                                </td>
                                <td>{{ $cnt }}</td>
                                <td>{{ $item->department_name }}</td>
                                <td>{!! count_worker_by_department_id($item->id) !!}</td>
                                
                                <td> 
                                    <a href="{{Route("admin.department.edit", $item->id)}}" class="btn btn-info">Sửa</a>
                                    <a href="{{Route("admin.department.delete", $item->id)}}" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            
            {{ $department->links() }}
        </div>
    </div>
    </div>

@endsection

@php
use App\Worker;
function count_worker_by_department_id($department_id)
{
    return Worker::where('department_id', $department_id)->count();
}
@endphp
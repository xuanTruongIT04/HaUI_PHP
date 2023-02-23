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
                        <th scope="col">Lương cơ bản</th>
                        <th scope="col">Phụ cấp</th>
                        <th scope="col">Khen thưởng</th>
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

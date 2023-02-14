<?php

namespace App\Http\Controllers;

use App\Departments;
use Illuminate\Http\Request;


class AdminDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => "departments"]);
            return $next($request);
        });
    }
    
    function list(Request $requests)
    {
        $departments = Departments::Paginate(20);
        return view('admin.department.list', compact('departments'));
    }

    public function add()
    {
        return view('admin.department.add');
    }

    public function store(Request $requests)
    {
        if ($requests->input('btn_add')) {
            $requests->validate(
                [
                    'department_name' => ['required'],
                    'quantity_worker' => ['required', 'numeric', 'min:0']
                ],
                [
                    'required' => ":attribute không được để trống",
                    "min" => [
                        "numeric" => ":attribute không được bé hơn :min.",
                    ]
                ],
                [
                    "department_name" => "Tên bộ phận",
                    "quantity_worker" => "Số lượng công nhân"
                ]
            );

            Departments::create($requests->all());
            return redirect()->route('admin.department.list')->with('message', "Thêm ca làm việc thành công");
        }
    }

    public function edit($id)
    {
        $department = Departments::find($id);
        return view('admin.department.edit', compact("department"));
    }

    public function update(Request $requests, $id)
    {
        Departments::where('id', $id)->update([
            'department_name' => $requests->input("department_name"),
            'quantity_worker' => $requests->input("quantity_worker")
        ]);
        return redirect()->route('admin.department.list')->with('message', "Cập nhật Bộ phận thành công");
    }

    public function action(Request $requests)
    {
    }

    public function delete($id)
    {
        $department = Departments::withTrashed()->find($id);
        $department_name = $department->department_name;
        $department->delete();
        return redirect()->back()->with("message", "Bạn đã bộ phận {$department_name} thành công");
    }

    public function restore($id)
    {
    }
}

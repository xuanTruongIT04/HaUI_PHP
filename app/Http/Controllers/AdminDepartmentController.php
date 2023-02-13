<?php

namespace App\Http\Controllers;

use App\Departments;
use Illuminate\Http\Request;


class AdminDepartmentController extends Controller
{
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
                    'department_code' => ['required'],
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
                    "department_code" => "Mã bộ phận",
                    "department_name" => "Tên bộ phận",
                    "quantity_worker" => "Số lượng công nhân"
                ]
            );

            $find_by_id = Departments::where('department_code', $requests->input('department_code'))->count();
            if (!empty($find_by_id)) {
                return redirect()->route('admin.department.add')->with('message', "Thêm thất bại! Trùng mã ca làm việc");
            } else {
                Departments::create($requests->all());
                return redirect()->route('admin.department.list')->with('message', "Thêm ca làm việc thành công");
            }
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
            'department_code' => $requests->input("department_code"),
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
        $department_code = $department->department_code;
        $department->delete();
        return redirect()->back()->with("message", "Bạn đã bộ phận có mã {$department_code} thành công");
    }

    public function restore($id)
    {
    }
}

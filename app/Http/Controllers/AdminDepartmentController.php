<?php

namespace App\Http\Controllers;

use App\Department;
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
        $department = Department::Paginate(20);
        return view('admin.department.list', compact('department'));
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
                ],
                [
                    'required' => ":attribute không được để trống",
                ],
                [
                    "department_name" => "Tên bộ phận",
                ]
            );

<<<<<<< HEAD
            Departments::create($requests->all());
=======
            Department::create($requests->all());
>>>>>>> d693082fd433130cc38eff42a34ffc475a914cd4
            return redirect()->route('admin.department.list')->with('message', "Thêm ca làm việc thành công");
        }
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('admin.department.edit', compact("department"));
    }

    public function update(Request $requests, $id)
    {
<<<<<<< HEAD
        Departments::where('id', $id)->update([
            'department_name' => $requests->input("department_name"),
            'quantity_worker' => $requests->input("quantity_worker")
=======
        Department::where('id', $id)->update([
            'department_name' => $requests->input("department_name")
>>>>>>> d693082fd433130cc38eff42a34ffc475a914cd4
        ]);
        return redirect()->route('admin.department.list')->with('message', "Cập nhật Bộ phận thành công");
    }

    public function action(Request $requests)
    {
    }

    public function delete($id)
    {
<<<<<<< HEAD
        $department = Departments::withTrashed()->find($id);
=======
        $department = Department::withTrashed()->find($id);
>>>>>>> d693082fd433130cc38eff42a34ffc475a914cd4
        $department_name = $department->department_name;
        $department->delete();
        return redirect()->back()->with("message", "Bạn đã bộ phận {$department_name} thành công");
    }

    public function restore($id)
    {
    }
}
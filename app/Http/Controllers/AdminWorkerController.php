<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Worker;
use App\Salary;
use App\WorkShift;
use App\Department;
use App\ProductionTeam;

class AdminWorkerController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => "worker"]);
            return $next($request);
        });
    }
    function list(Request $requests)
    {
        $workers = Worker::Paginate(20);
        return view('admin.worker.list', compact('workers'));
    }

    public function add()
    {
        $listDepartment = Department::all();
        $listSalary = Salary::all();
        $listWorkShift = WorkShift::all();
        $listProductionTeam = ProductionTeam::all();
        return view('admin.worker.add', compact('listDepartment', 'listSalary', 'listWorkShift', 'listProductionTeam'));
    }

    public function store(Request $requests)
    {
        if ($requests->input('btn_add')) {
            $requests->validate(
                [
                    'worker_name' => ['required'],
                    'old' => ['required'],
                    'address' => ['required'],
                    'number_of_working_days' => ['required'],
                    'number_of_overtime' => ['required'],
                    'salary_id' => ['required'],
                    'department_id' => ['required'],
                    'work_shift_id' => ['required'],
                    'status' => ['required']
                ],
                ['required' => ":attribute không được để trống"],
                [
                    "worker_name" => "Tên công nhân",
                    "old" => "Tuổi",
                    "address" => "Địa chỉ",
                    "number_of_working_days" => "Số ngày làm việc",
                    "number_of_overtime" => "Số giờ tăng ca",
                    "salary_id" => "Mã lương",
                    "department_id" => "Mã bộ phận",
                    "work_shift_id" => "Mã ca làm việc",
                    "Status" => "Trạng thái làm việc"

                ]
            );

            Worker::create($requests->all());
            return redirect()->route('admin.worker.list')->with('message', "Thêm thông tin công nhân thành công");
        }
    }

    public function edit($id)
    {
        $workshift = Worker::find($id);
        return view('admin.worker.edit', compact("workshift"));
    }

    public function update(Request $requests, $id)
    {
        // $workshift->update($requests->all());
        Worker::where('id', $id)->update([
            'worker_name' => $requests->input("worker_name"),
            'old' => $requests->input("old"),
            'address' => $requests->input("address"),
            'number_of_working_days' => $requests->input("number_of_working_days"),
            'number_of_overtime' => $requests->input("number_of_overtime"),
            'salary_id' => $requests->input("salary_id"),
            'department_id' => $requests->input("department_id"),
            'work_shift_id' => $requests->input("work_shift_id")
        ]);
        return redirect()->route('admin.worker.list')->with('message', "Cập nhật ca làm việc thành công");
    }

    public function action(Request $requests)
    {
    }

    public function delete($id)
    {
        // $worker = Worker::withTrashed()->find($id);
        // $worker_name = $worker->worker_name;
        // $worker->delete();
        // return redirect()->back()->with("message", "Bạn đã xoá ca làm việc {$worker_name} thành công");
    }

    public function restore($id)
    {
    }
}
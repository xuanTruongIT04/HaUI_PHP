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
        $status = !empty(request()->input('status')) ? $requests->input('status') : 'active';
        $key_word = "";

        if ($requests->input("key_word")) {
            $key_word = $requests->input("key_word");
        }

        if ($status == "active") {
            $workers = Worker::withoutTrashed()->where("worker_name", "LIKE", "%{$key_word}%")->Paginate(20);
        } else if ($status == "working") {
            $workers = Worker::withoutTrashed()->where("status", 1)->Paginate(20);
        } else if ($status == "quit") {
            $workers = Worker::withoutTrashed()->where("status", 0)->Paginate(20);
        } else if ($status == "all") {
            $workers = Worker::Paginate(20);
        } else {
            $workers = Worker::Paginate(20);
        }

        $cnt_worker_working = Worker::withoutTrashed()->where("status", 1)->count();
        $cnt_worker_quit = Worker::withoutTrashed()->where("status", 0)->count();
        $cnt_worker_all = Worker::count();
        $count_worker_status = [$cnt_worker_all, $cnt_worker_working, $cnt_worker_quit];
        return view('admin.worker.list', compact('workers', 'count_worker_status'));
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
        $worker = Worker::find($id);
        $listDepartment = Department::all();
        $listSalary = Salary::all();
        $listWorkShift = WorkShift::all();
        $listProductionTeam = ProductionTeam::all();
        return view('admin.worker.edit', compact("worker", "listDepartment", "listSalary", "listWorkShift", "listProductionTeam"));
    }

    public function update(Request $requests, $id)
    {
        Worker::where('id', $id)->update([
            'worker_name' => $requests->input("worker_name"),
            'old' => $requests->input("old"),
            'address' => $requests->input("address"),
            'number_of_working_days' => $requests->input("number_of_working_days"),
            'number_of_overtime' => $requests->input("number_of_overtime"),
            'salary_id' => $requests->input("salary_id"),
            'status' => $requests->input("status"),
            'department_id' => $requests->input("department_id"),
            'work_shift_id' => $requests->input("work_shift_id")
        ]);
        return redirect()->route('admin.worker.list')->with('message', "Cập nhật thông tin công nhân thành công");
    }

    public function action(Request $requests)
    {
    }

    public function delete($id)
    {
        $worker = Worker::withTrashed()->find($id);
        $worker_name = $worker->worker_name;
        $worker->delete();
        return redirect()->back()->with("message", "Bạn đã xoá công nhân {$worker_name} thành công");
    }

    public function restore($id)
    {
    }
}

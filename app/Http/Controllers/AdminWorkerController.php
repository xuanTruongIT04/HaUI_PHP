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
                    'birthday' => ['required'],
                    'address' => ['required'],
                    'number_of_working_days' => ['required'],
                    'number_of_overtime' => ['required'],
                    'salary_id' => ['required'],
                    'department_id' => ['required'],
                    'work_shift_id' => ['required'],
                    'status' => ['required']
                ],
                ['required' => ":attribute kh??ng ???????c ????? tr???ng"],
                [
                    "worker_name" => "T??n c??ng nh??n",
                    "birthday" => "Ng??y sinh",
                    "address" => "?????a ch???",
                    "number_of_working_days" => "S??? ng??y l??m vi???c",
                    "number_of_overtime" => "S??? gi??? t??ng ca",
                    "salary_id" => "M?? l????ng",
                    "department_id" => "M?? b??? ph???n",
                    "work_shift_id" => "M?? ca l??m vi???c",
                    "Status" => "Tr???ng th??i l??m vi???c"

                ]
            );

            Worker::create($requests->all());
            return redirect()->route('admin.worker.list')->with('message', "Th??m th??ng tin c??ng nh??n th??nh c??ng");
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
            'birthday' => $requests->input("birthday"),
            'address' => $requests->input("address"),
            'number_of_working_days' => $requests->input("number_of_working_days"),
            'number_of_overtime' => $requests->input("number_of_overtime"),
            'salary_id' => $requests->input("salary_id"),
            'status' => $requests->input("status"),
            'department_id' => $requests->input("department_id"),
            'work_shift_id' => $requests->input("work_shift_id")
        ]);
        return redirect()->route('admin.worker.list')->with('message', "C???p nh???t th??ng tin c??ng nh??n th??nh c??ng");
    }

    public function action(Request $requests)
    {
    }

    public function delete($id)
    {
        $worker = Worker::withTrashed()->find($id);
        $worker_name = $worker->worker_name;
        $worker->delete();
        return redirect()->back()->with("message", "B???n ???? xo?? c??ng nh??n {$worker_name} th??nh c??ng");
    }

    public function restore($id)
    {
    }
}

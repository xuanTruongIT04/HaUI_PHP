<?php

namespace App\Http\Controllers;

use App\WorkShift;
use Illuminate\Http\Request;


class AdminWorkShiftController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => "work_shift"]);
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

        if ($key_word != "" && $status == "active") {
            $workShifts = WorkShift::withoutTrashed()->where("id", $key_word)->Paginate(20);
        } else if ($key_word == "" && $status == "active") {
            $workShifts = WorkShift::Paginate(20);
        } else {
            $workShifts = WorkShift::Paginate(20);
        }

        return view('admin.workShift.list', compact('workShifts'));
    }

    public function add()
    {
        return view('admin.workShift.add');
    }

    public function store(Request $requests)
    {
        if ($requests->input('btn_add')) {
            $requests->validate(
                [
                    'time_start' => ['required'],
                    'time_end' => ['required']
                ],
                ['required' => ":attribute không được để trống"],
                [
                    "time_start" => "Thời gian bắt đầu",
                    "time_end" => "Thời gian kết thúc"
                ]
            );

            WorkShift::create($requests->all());
            return redirect()->route('admin.workshift.list')->with('message', "Thêm ca làm việc thành công");
        }
    }

    public function edit($id)
    {
        $workshift = WorkShift::find($id);
        return view('admin.workshift.edit', compact("workshift"));
    }

    public function update(Request $requests, $id)
    {
        // $workshift->update($requests->all());
        WorkShift::where('id', $id)->update([
            'time_start' => $requests->input("time_start"),
            'time_end' => $requests->input("time_end")
        ]);
        return redirect()->route('admin.workshift.list')->with('message', "Cập nhật ca làm việc thành công");
    }

    public function action(Request $requests)
    {
    }

    public function delete($id)
    {
        $workshift = WorkShift::withTrashed()->find($id);
        $work_shift_code = $workshift->id;
        $workshift->delete();
        return redirect()->back()->with("message", "Bạn đã xoá ca làm việc {$work_shift_code} thành công");
    }

    public function restore($id)
    {
    }
}
<?php

namespace App\Http\Controllers;

use App\WorkShift;
use Illuminate\Http\Request;

class AdminWorkShiftController extends Controller
{

  function list(Request $requests)
  {
    $workShift = WorkShift::Paginate(20);
    return view('admin.workShift.list', compact('workShift'));
  }

  public function add()
  {
    return view('admin.workShift.add');
  }

  public function store(Request $requests)
  {
    WorkShift::create($requests->all());
    return redirect()->route('admin.workshift.list')->with('message', "Thêm ca làm việc thành công");
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
      'work_shift_code' => $requests->input("work_shift_code"),
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
    $work_shift_code = $workshift->work_shift_code;
    $workshift->delete();
    return redirect()->back()->with("message", "Bạn đã xoá ca làm việc {$work_shift_code} thành công");
  }

  public function restore($id)
  {
  }
}

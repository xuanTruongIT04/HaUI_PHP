<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salary;

class AdminSalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => "salary"]);
            return $next($request);
        });
    }
    function list(Request $requests)
    {
        $salaries = Salary::Paginate(20);
        return view('admin.salary.list', compact('salaries'));
    }

    public function add()
    {
        return view('admin.salary.add');
    }

    public function store(Request $requests)
    {
        if ($requests->input('btn_add')) {
            $requests->validate(
                [
                    'basic_salary' => ['required'],
                    'allowance' => ['required'],
                    'bonus' => ['required'],
                ],
                ['required' => ":attribute không được để trống"],
                [
                    "basic_salary" => "Lương cơ bản",
                    "allowance" => "Phụ cấp",
                    "bonus" => "Khen thưởng"
                ]
            );

            Salary::create($requests->all());
            return redirect()->route('admin.salary.list')->with('message', "Thêm lương thành công");
        }
    }

    public function edit($id)
    {
        $salary = Salary::find($id);
        return view('admin.salary.edit', compact("salary"));
    }

    public function update(Request $requests, $id)
    {
        // $workshift->update($requests->all());
        Salary::where('id', $id)->update([
            "basic_salary" => $requests->input('basic_salary'),
            "allowance" => $requests->input('allowance'),
            "bonus" =>  $requests->input('bonus')

        ]);
        return redirect()->route('admin.salary.list')->with('message', "Cập nhật lương thành công");
    }

    public function action(Request $requests)
    {
    }

    public function delete($id)
    {
        $salary = Salary::withTrashed()->find($id);
        $salary_code = $salary->id;
        $salary->delete();
        return redirect()->back()->with("message", "Bạn đã xoá lương có mã lương là {$salary_code} thành công");
    }

    public function restore($id)
    {
    }
}

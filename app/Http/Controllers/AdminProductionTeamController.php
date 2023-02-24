<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductionTeam;
use App\Department;

class AdminProductionTeamController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => "production_team"]);
            return $next($request);
        });
    }

    function list(Request $requests)
    {
        $status = !empty(request()->input('status')) ? $requests->input('status') : 'active';
        $key_word = "";
        $listDepartment = Department::all();
        $dep_id = null;

        if ($requests->input("key_word")) {
            $key_word = $requests->input("key_word");
        }

        if (($requests->input("filter_dep")) != null) {
            $status = "filter_by_department";
            $dep_id = $requests->input("filter_dep");
        }

        if ($status == "active") {
            $productionTeams = ProductionTeam::withoutTrashed()->where("production_team_name", "LIKE", "%{$key_word}%")->Paginate(20);
        } else if ($status == "filter_by_department") {
            $productionTeams = ProductionTeam::withoutTrashed()->where("department_id", "=", $dep_id)->Paginate(20);
        } else {
            $productionTeams = ProductionTeam::Paginate(20);
        }

        return view('admin.productionTeam.list', compact('productionTeams', 'listDepartment'));
    }

    public function add()
    {
        $listDepartment = Department::all();
        return view('admin.productionTeam.add', compact('listDepartment'));
    }

    public function store(Request $requests)
    {
        if ($requests->input('btn_add')) {
            $requests->validate(
                [
                    'production_team_name' => ['required'],
                    'department_id' => ['required']
                ],
                [
                    'required' => ":attribute không được để trống",
                ],
                [
                    "production_team_name" => "Tên tổ sản xuất",
                    "department_id" => "Mã bộ phận"
                ]
            );

            ProductionTeam::create([
                'production_team_name' => $requests->input("production_team_name"),
                'department_id' => $requests->input("department_id")

            ]);

            return redirect()->route('admin.productionTeam.list')->with('message', "Thêm tổ sản xuất thành công");
        }
    }

    public function edit($id)
    {
        $listDepartment = Department::all();
        $productionTeam = ProductionTeam::find($id);
        return view('admin.productionTeam.edit', compact("productionTeam", "listDepartment"));
    }

    public function update(Request $requests, $id)
    {
        ProductionTeam::where('id', $id)->update([
            'production_team_name' => $requests->input("production_team_name"),
            'department_id' => $requests->input("department_id")
        ]);
        return redirect()->route('admin.productionTeam.list')->with('message', "Cập nhật Tổ sản xuất thành công");
    }

    public function action(Request $requests)
    {
    }

    public function delete($id)
    {
        $productionTeam = ProductionTeam::withTrashed()->find($id);
        $production_team_name = $productionTeam->department_name;
        $productionTeam->delete();
        return redirect()->back()->with("message", "Bạn đã xóa tổ sản xuất {$production_team_name} thành công");
    }

    public function restore($id)
    {
    }
}

// VIET VAO DAY, LUU Y NGOAI CLASS, NEU TRONG CLASS THI NO THANH ACTION KHONG DUOC TINH LA HAM
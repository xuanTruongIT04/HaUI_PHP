<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductionEquipment;
use App\ProductionTeam;

class AdminProductionEquipmentController extends Controller
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
            $productionEquipments = ProductionEquipment::withoutTrashed()->where("equipment_name", "LIKE", "%{$key_word}%")->Paginate(20);
        } else {
            $productionEquipments = ProductionEquipment::Paginate(20);
        }

        return view('admin.productionEquipment.list', compact('productionEquipments'));
    }

    public function add()
    {
        $productionTeams = ProductionTeam::all();
        return view('admin.productionEquipment.add', compact('productionTeams'));
    }

    public function store(Request $requests)
    {
        if ($requests->input('btn_add')) {
            $requests->validate(
                [
                    'equipment_name' => ['required'],
                    'status' => ['required'],
                    'quantity' => ['required'],
                    'price' => ['required'],
                    'output_time' => ['required'],
                    'maintenance_time' => ['required'],
                    'specifications' => ['required'],
                    'describe' => ['required'],
                    'production_team_id' => ['required'],
                ],
                [
                    'required' => ":attribute không được để trống",
                ],
                [
                    'equipment_name' => "Tên thiết bị",
                    'status' => "Tình trạng",
                    'quantity' => "Số lượng",
                    'price' => "Giá thành",
                    'output_time' => "Thời gian sản xuất",
                    'maintenance_time' => "Thời gian bảo dưỡng",
                    'specifications' => "Thông số kỹ thuật",
                    'describe' => "Mô tả",
                    'production_team_id' => "Mã tổ sản xuất",
                ]
            );

            ProductionEquipment::create($requests->all());
            return redirect()->route('admin.productionEquipment.list')->with('message', "Thêm thông tin thiết bị thành công");
        }
    }

    public function edit($id)
    {
        $productionEquipment = ProductionEquipment::find($id);
        return view('admin.productionEquipment.edit', compact("productionEquipment"));
    }

    public function update(Request $requests, $id)
    {
        ProductionEquipment::where('id', $id)->update([
            'equipment_name' => $requests->input("equipment_name")
        ]);
        return redirect()->route('admin.productionEquipment.list')->with('equipment_name', "Cập nhật thông tin thiết bị thành công");
    }

    public function action(Request $requests)
    {
    }

    public function delete($id)
    {
        $productionEquipment = ProductionEquipment::withTrashed()->find($id);
        $productionEquipment->delete();
        return redirect()->back()->with("message", "Bạn đã thông tin thiết bị thành công");
    }

    public function restore($id)
    {
    }
}

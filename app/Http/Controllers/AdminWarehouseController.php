<?php

namespace App\Http\Controllers;

use App\WareHouse;
use Illuminate\Http\Request;

class AdminWarehouseController extends Controller
{
    //
    public function __construct() {
        $this->middleware(function ($request, $next) {
            session(['module_active' => "warehouse"]);
            return $next($request);
        });
    }

    function list(Request $requests) {
        $status = !empty(request()->input('status')) ? request()->input('status') : 'active';
        $list_act = [
            "delete" => "Ngừng hoạt động",
        ];

        $key_word = ""; 

        if ($requests->input("key_word")) {
            $key_word = $requests->input("key_word");
        }

        if ($status == "trashed") {
            $list_act = [
                "restore" => "Khôi phục",
                "delete_permanently" => "Xoá vĩnh viễn",
            ];
            $warehouses = WareHouse::onlyTrashed()->where("warehouse_name", "LIKE", "%{$key_word}%")->orderbyDesc("created_at")->Paginate(20);
        } else {
            $warehouses = WareHouse::withoutTrashed()->where("warehouse_name", "LIKE", "%{$key_word}%")->orderbyDesc("created_at")->Paginate(20);
        }

        $count_warehouse = $warehouses->total();
        $cnt_warehouse_active = WareHouse::withoutTrashed()->count();
        $cnt_warehouse_trashed = WareHouse::onlyTrashed()->count();
        $count_warehouse_status = [$cnt_warehouse_active, $cnt_warehouse_trashed];
        return view("admin.warehouse.list", compact('warehouses', "count_warehouse", "count_warehouse_status", "list_act"));
    }


    public function add()
    {
        $warehouses = Warehouse::all();
        return view('admin.warehouse.add', compact("warehouses"));
    }

    public function store(Request $requests)
    {
        if ($requests->input('btn_add')) {
            $requests->validate(
                [
                    'warehouse_name' => ['required', 'string', 'max:300'],
                    'warehouse_location' => ['required', 'string', 'max:300'],
                ],
                [
                    'required' => ":attribute không được để trống",
                    'string' => ":attribute phải là chuỗi",
                    'max' => ":attribute có độ dài ít nhất :max ký tự",
                ],
                [
                    "warehouse_name" => "Tên kho",
                    "warehouse_location" => "Vị trí kho",
                ]
            );

            $name_warehouse = $requests->input("warehouse_name");

            Warehouse::create([
                'warehouse_name' => $name_warehouse,
                'warehouse_location' => $requests -> input("warehouse_location"),
            ]);

            return redirect("admin/warehouse/list")->with("status", "Đã thêm kho tên {$name_warehouse} thành công");
        }
    }

    public function edit($id)
    {
        $warehouses = Warehouse::all();
        $warehouse = Warehouse::find($id);

        return view("admin.warehouse.edit", compact("warehouse", "warehouses"));
    }

    public function update(Request $requests, $id)
    {
        if ($requests->input('btn_update')) {
            $requests->validate(
                [
                    'warehouse_name' => ['required', 'string', 'max:300'],
                    'warehouse_location' => ['required', 'string', 'max:300'],
                ],
                [
                    'required' => ":attribute không được để trống",
                    'string' => ":attribute phải là chuỗi",
                    'max' => ":attribute có độ dài ít nhất :max ký tự",
                ],
                [
                    "warehouse_name" => "Tên kho",
                    "warehouse_location" => "Vị trí kho",
                ]
            );

            $name_warehouse = $requests->input("warehouse_name");

            Warehouse::where('id', $id)->update([
                'warehouse_name' => $name_warehouse,
                'warehouse_location' => $requests -> input("warehouse_location"),
            ]);

            return redirect("admin/warehouse/list")->with("status", "Đã cập nhật thông tin kho tên {$name_warehouse} thành công");
        }
    }

    public function action(Request $requests)
    {
        $list_checked = $requests->input("list_check");
        $act = $requests->input('act');
        if ($act != "") {
            if ($list_checked) {
                $cnt_member = count($list_checked);
                if ($cnt_member > 0) {
                    if ($act == "delete") {
                        Warehouse::destroy($list_checked);
                        return redirect("admin/warehouse/list")->with("status", "Bạn đã đặt trạng thái ngừng hoạt động cho {$cnt_member} kho thành công!");
                    } else if ($act == "delete_permanently") {
                        Warehouse::onlyTrashed()
                            ->whereIn("id", $list_checked)
                            ->forceDelete();
                        return redirect()->back()->with("status", "Bạn đã xoá vĩnh viễn {$cnt_member} kho thành công");
                    } else if ($act == "restore") {
                        Warehouse::onlyTrashed()
                            ->whereIn("id", $list_checked)
                            ->restore();
                        return redirect("admin/warehouse/list")->with("status", "Bạn đã khôi phục {$cnt_member} kho thành công");
                    }
                } else {
                    return redirect()->back()->with("status", "Không tìm thấy kho nào!");
                }
            } else {
                return redirect()->back()->with("status", "Bạn chưa chọn kho nào để thực hiện hành động!");
            }
        } else {
            return redirect()->back()->with("status", "Bạn chưa chọn hành động nào để thực hiện!");
        }
    }

    public function delete($id)
    {
        $warehouse = Warehouse::withTrashed()->find($id);
        $name_warehouse = $warehouse->warehouse_name;

        if (empty($warehouse->deleted_at)) {
            $warehouse->delete();
            return redirect()->back()->with("status", "Bạn đã đặt trạng thái ngừng hoạt động cho kho tên {$name_warehouse} thành công");
        } else {

            $warehouse->forceDelete();
            return redirect()->back()->with("status", "Bạn đã xoá vĩnh viễn kho tên {$name_warehouse} thành công");
        }
    }

    public function restore($id)
    {
        $warehouse = Warehouse::withTrashed()->find($id);
        $name_warehouse = $warehouse->warehouse_name;
        $warehouse->restore();
        return redirect("admin/warehouse/list")->with("status", "Bạn đã khôi phục kho tên {$name_warehouse} thành công");
    }
}

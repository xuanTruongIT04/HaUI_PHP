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
            "delete" => "Xoá tạm thời",
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
            $warehouses = WareHouse::onlyTrashed()->where("warehouse_location", "LIKE", "%{$key_word}%")->orderbyDesc("created_at")->Paginate(20);
        } else {
            $warehouses = WareHouse::withoutTrashed()->where("warehouse_location", "LIKE", "%{$key_word}%")->orderbyDesc("created_at")->Paginate(20);
        }

        $count_warehouse = $warehouses->total();
        $cnt_warehouse_active = WareHouse::withoutTrashed()->count();
        $cnt_warehouse_trashed = WareHouse::onlyTrashed()->count();
        $count_warehouse_status = [$cnt_warehouse_active, $cnt_warehouse_trashed];
        return view("admin.warehouse.list", compact('warehouses', "count_warehouse", "count_warehouse_status", "list_act"));
    }
}

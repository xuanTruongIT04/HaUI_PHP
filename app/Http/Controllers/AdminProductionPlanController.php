<?php

namespace App\Http\Controllers;

use App\ProductionPlan;
use Illuminate\Http\Request;


class AdminProductionPlanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => "production_plan"]);
            return $next($request);
        });
    }

    function list(Request $requests) {
        $status = !empty(request()->input('status')) ? request()->input('status') : 'active';
        $list_act = [
            "delete" => "Huỷ kế hoạch",
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
            $productionPlans = ProductionPlan::onlyTrashed()->where("production_plan_name", "LIKE", "%{$key_word}%")->Paginate(20);
        } else {
            $productionPlans = ProductionPlan::withoutTrashed()->where("production_plan_name", "LIKE", "%{$key_word}%")->Paginate(20);
        }

        $count_productionPlan = $productionPlans->total();
        $cnt_productionPlan_active = ProductionPlan::withoutTrashed()->count();
        $cnt_productionPlan_trashed = ProductionPlan::onlyTrashed()->count();
        $count_productionPlan_status = [$cnt_productionPlan_active, $cnt_productionPlan_trashed];
        return view("admin.productionPlan.list", compact('productionPlans', "count_productionPlan", "count_productionPlan_status", "list_act"));
    }

    public function add()
    {
        $productionPlans = ProductionPlan::all();
        return view('admin.productionPlan.add', compact("productionPlans"));
    }

    public function store(Request $requests)
    {
        if ($requests->input('btn_add')) {
            $requests->validate(
                [
                    'production_plan_name' => ['required', 'string', 'max:300'],
                    'start_date' => ['date'],
                    'date_end' => ['date'],
                ],
                [
                    'required' => ":attribute không được để trống",
                    'max' => ":attribute có độ dài ít nhất :max ký tự",
                ],
                [
                    "production_plan_name" => "Tên kế hoạch sản xuất",
                    "start_date" => "Ngày bắt đầu kế hoạch",
                    "date_end" => "Ngày kết thúc kế hoạch",
                ]
            );

            $name_productionPlan = $requests->input("production_plan_name");

            ProductionPlan::create([
                'production_plan_name' => $name_productionPlan,
                'start_date' => $requests->input("start_date"),
                'date_end' => $requests->input("date_end"),
            ]);

            return redirect("admin/productionPlan/list")->with("status", "Đã thêm kế hoạch sản xuất tên {$name_productionPlan} thành công");
        }
    }

    public function edit($id)
    {
        $productionPlans = ProductionPlan::all();
        $productionPlan = ProductionPlan::find($id);

        return view("admin.productionPlan.edit", compact("productionPlan", "productionPlans"));
    }

    public function update(Request $requests, $id)
    {
        if ($requests->input('btn_update')) {
            $requests->validate(
                [
                    'production_plan_name' => ['required', 'string', 'max:300'],
                    'start_date' => ['date'],
                    'date_end' => ['date'],
                ],
                [
                    'required' => ":attribute không được để trống",
                    'max' => ":attribute có độ dài ít nhất :max ký tự",
                ],
                [
                    "production_plan_name" => "Tên kế hoạch sản xuất",
                    "start_date" => "Ngày bắt đầu kế hoạch",
                    "date_end" => "Ngày kết thúc kế hoạch",
                ]
            );

            $name_productionPlan = $requests->input("production_plan_name");

            ProductionPlan::where('id', $id)->update([
                'production_plan_name' => $name_productionPlan,
                'start_date' => $requests->input("start_date"),
                'date_end' => $requests->input("date_end"),
            ]);

            return redirect("admin/productionPlan/list")->with("status", "Đã cập nhật thông tin kế hoạch sản xuất tên {$name_productionPlan} thành công");
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
                        ProductionPlan::destroy($list_checked);
                        return redirect("admin/productionPlan/list")->with("status", "Bạn đã xoá tạm thời {$cnt_member} kế hoạch sản xuất thành công!");
                    } else if ($act == "delete_permanently") {
                        ProductionPlan::onlyTrashed()
                            ->whereIn("id", $list_checked)
                            ->forceDelete();
                        return redirect()->back()->with("status", "Bạn đã xoá vĩnh viễn {$cnt_member} kế hoạch sản xuất thành công");
                    } else if ($act == "restore") {
                        ProductionPlan::onlyTrashed()
                            ->whereIn("id", $list_checked)
                            ->restore();
                        return redirect("admin/productionPlan/list")->with("status", "Bạn đã khôi phục {$cnt_member} kế hoạch sản xuất thành công");
                    }
                } else {
                    return redirect()->back()->with("status", "Không tìm thấy kế hoạch sản xuất nào!");
                }
            } else {
                return redirect()->back()->with("status", "Bạn chưa chọn kế hoạch sản xuất nào để thực hiện hành động!");
            }
        } else {
            return redirect()->back()->with("status", "Bạn chưa chọn hành động nào để thực hiện!");
        }
    }

    public function delete($id)
    {
        $productionPlan = ProductionPlan::withTrashed()->find($id);
        $name_productionPlan = $productionPlan->name_productionPlan;

        if (empty($productionPlan->deleted_at)) {
            $productionPlan->delete();
            return redirect()->back()->with("status", "Bạn đã xoá tạm thời kế hoạch sản xuất tên {$name_productionPlan} thành công");
        } else {

            $productionPlan->forceDelete();
            return redirect()->back()->with("status", "Bạn đã xoá vĩnh viễn kế hoạch sản xuất tên {$name_productionPlan} thành công");
        }
    }

    public function restore($id)
    {
        $productionPlan = ProductionPlan::withTrashed()->find($id);
        $name_productionPlan = $productionPlan->name_productionPlan;
        $productionPlan->restore();
        return redirect("admin/productionPlan/list")->with("status", "Bạn đã khôi phục kế hoạch sản xuất tên {$name_productionPlan} thành công");
    }

}

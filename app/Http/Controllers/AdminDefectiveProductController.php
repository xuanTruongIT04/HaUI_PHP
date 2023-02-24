<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DefectiveProduct;

class AdminDefectiveProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => "defectiveProduct"]);
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
            $defectiveProducts = DefectiveProduct::onlyTrashed()->where("name_defectiveProduct", "LIKE", "%{$key_word}%")->Paginate(20);
        } else {
            $defectiveProducts = DefectiveProduct::withoutTrashed()->where("name_defectiveProduct", "LIKE", "%{$key_word}%")->Paginate(20);
        }

        $count_defectiveProduct = $defectiveProducts->total();
        $cnt_defectiveProduct_active = DefectiveProduct::withoutTrashed()->count();
        $cnt_defectiveProduct_trashed = DefectiveProduct::onlyTrashed()->count();
        $count_defectiveProduct_status = [$cnt_defectiveProduct_active, $cnt_defectiveProduct_trashed];
        return view("admin.defectiveProduct.list", compact('defectiveProducts', "count_defectiveProduct", "count_defectiveProduct_status", "list_act"));
    }

    public function edit($id)
    {
        $defectiveProducts = DefectiveProduct::all();
        $defectiveProduct = DefectiveProduct::find($id);

        return view("admin.defectiveProduct.edit", compact("defectiveProduct", "defectiveProducts"));
    }

    public function update(Request $requests, $id)
    {
        if ($requests->input('btn_update')) {
            $requests->validate(
                [
                    'name_defectiveProduct' => ['required', 'string', 'max:300'],
                ],
                [
                    'required' => ":attribute không được để trống",
                    'max' => ":attribute có độ dài ít nhất :max ký tự",
                ],
                [
                    "name_defectiveProduct" => "Tên quyền",
                ]
            );

            $name_defectiveProduct = $requests->input("name_defectiveProduct");

            DefectiveProduct::where('id', $id)->update([
                'name_defectiveProduct' => $name_defectiveProduct,
            ]);

            return redirect("admin/defectiveProduct/list")->with("status", "Đã cập nhật thông tin quyền tên {$name_defectiveProduct} thành công");
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
                        DefectiveProduct::destroy($list_checked);
                        return redirect("admin/defectiveProduct/list")->with("status", "Bạn đã xoá tạm thời {$cnt_member} quyền thành công!");
                    } else if ($act == "delete_permanently") {
                        DefectiveProduct::onlyTrashed()
                            ->whereIn("id", $list_checked)
                            ->forceDelete();
                        return redirect()->back()->with("status", "Bạn đã xoá vĩnh viễn {$cnt_member} quyền thành công");
                    } else if ($act == "restore") {
                        DefectiveProduct::onlyTrashed()
                            ->whereIn("id", $list_checked)
                            ->restore();
                        return redirect("admin/defectiveProduct/list")->with("status", "Bạn đã khôi phục {$cnt_member} quyền thành công");
                    }
                } else {
                    return redirect()->back()->with("status", "Không tìm thấy quyền nào!");
                }
            } else {
                return redirect()->back()->with("status", "Bạn chưa chọn quyền nào để thực hiện hành động!");
            }
        } else {
            return redirect()->back()->with("status", "Bạn chưa chọn hành động nào để thực hiện!");
        }
    }

    public function delete($id)
    {
        $defectiveProduct = DefectiveProduct::withTrashed()->find($id);
        $name_defectiveProduct = $defectiveProduct->name_defectiveProduct;

        if (empty($defectiveProduct->deleted_at)) {
            $defectiveProduct->delete();
            return redirect()->back()->with("status", "Bạn đã xoá tạm thời quyền tên {$name_defectiveProduct} thành công");
        } else {

            $defectiveProduct->forceDelete();
            return redirect()->back()->with("status", "Bạn đã xoá vĩnh viễn quyền tên {$name_defectiveProduct} thành công");
        }
    }

    public function restore($id)
    {
        $defectiveProduct = DefectiveProduct::withTrashed()->find($id);
        $name_defectiveProduct = $defectiveProduct->name_defectiveProduct;
        $defectiveProduct->restore();
        return redirect("admin/defectiveProduct/list")->with("status", "Bạn đã khôi phục quyền tên {$name_defectiveProduct} thành công");
    }

}

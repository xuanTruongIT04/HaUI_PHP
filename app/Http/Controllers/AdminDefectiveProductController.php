<?php

namespace App\Http\Controllers;

use App\DefectiveProduct;
use App\Product;
use Illuminate\Http\Request;

class AdminDefectiveProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => "product"]);
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
            // $defectiveProducts = DefectiveProduct::onlyTrashed()->where("product_name", "LIKE", "%{$key_word}%")->where("is_error", "1")->Paginate(20);
            $defectiveProducts = DefectiveProduct::join("products", "products.id", "=", "defective_products.product_id")
                ->onlyTrashed()->where("product_name", "LIKE", "%{$key_word}%")
                ->select("products.product_name", "defective_products.id", "can_fix", "error_time", "error_reason")
                ->Paginate(20);
        } else {
            // $defectiveDefectiveProducts = Product::withoutTrashed()->where("product_name", "LIKE", "%{$key_word}%")->where("is_error", "1")->Paginate(20);
            $defectiveProducts = DefectiveProduct::join("products", "products.id", "=", "defective_products.product_id")
                ->withoutTrashed()->where("product_name", "LIKE", "%{$key_word}%")
                ->select("products.product_name", "defective_products.id", "can_fix", "error_time", "error_reason")
                ->Paginate(20);
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
        // $defectiveProduct = DefectiveProduct::find($id);
        $defectiveProduct = DefectiveProduct::join("products", "products.id", "=", "defective_products.product_id")
            ->withoutTrashed()->where("defective_products.id", $id)
            ->select("products.product_name", "defective_products.id", "can_fix", "error_time", "error_reason")
            ->first();

        return view("admin.defectiveProduct.edit", compact("defectiveProduct", "defectiveProducts"));
    }

    public function update(Request $requests, $id)
    {
        if ($requests->input('btn_update')) {
            $requests->validate(
                [
                    'error_reason' => ['required', 'string', 'max:300'],
                ],
                [
                    'required' => ":attribute không được để trống",
                    'max' => ":attribute có độ dài ít nhất :max ký tự",
                ],
                [
                    "error_reason" => "Lí do khiến sản phẩm lỗi",
                ]
            );

            $name_defectiveProduct = DefectiveProduct::join("products", "products.id", "=", "defective_products.product_id")
                                                     ->where("defective_products.id", $id)
                                                     ->select("product_name")
                                                     ->first()
                                                     ->product_name;
            DefectiveProduct::where('id', $id)->update([
                'error_reason' => $requests -> input("error_reason"),
                'can_fix' => $requests -> input("defective_product_status"),
            ]);

            return redirect("admin/defectiveProduct/list")->with("status", "Đã cập nhật thông tin sản phẩm lỗi tên {$name_defectiveProduct} thành công");
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
                        return redirect("admin/defectiveProduct/list")->with("status", "Bạn đã xoá tạm thời {$cnt_member} sản phẩm lỗi thành công!");
                    } else if ($act == "delete_permanently") {
                        DefectiveProduct::onlyTrashed()
                            ->whereIn("id", $list_checked)
                            ->forceDelete();
                        return redirect()->back()->with("status", "Bạn đã xoá vĩnh viễn {$cnt_member} sản phẩm lỗi thành công");
                    } else if ($act == "restore") {
                        DefectiveProduct::onlyTrashed()
                            ->whereIn("id", $list_checked)
                            ->restore();
                        return redirect("admin/defectiveProduct/list")->with("status", "Bạn đã khôi phục {$cnt_member} sản phẩm lỗi thành công");
                    }
                } else {
                    return redirect()->back()->with("status", "Không tìm thấy sản phẩm lỗi nào!");
                }
            } else {
                return redirect()->back()->with("status", "Bạn chưa chọn sản phẩm lỗi nào để thực hiện hành động!");
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
            return redirect()->back()->with("status", "Bạn đã xoá tạm thời sản phẩm lỗi tên {$name_defectiveProduct} thành công");
        } else {

            $defectiveProduct->forceDelete();
            return redirect()->back()->with("status", "Bạn đã xoá vĩnh viễn sản phẩm lỗi tên {$name_defectiveProduct} thành công");
        }
    }

    public function restore($id)
    {
        $defectiveProduct = DefectiveProduct::withTrashed()->find($id);
        $name_defectiveProduct = $defectiveProduct->name_defectiveProduct;
        $defectiveProduct->restore();
        return redirect("admin/defectiveProduct/list")->with("status", "Bạn đã khôi phục sản phẩm lỗi tên {$name_defectiveProduct} thành công");
    }

}

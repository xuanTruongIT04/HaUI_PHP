<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Material;
use App\DefectiveProduct;
use App\Stage;
class AdminMaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => "material"]);
            return $next($request);
        });
  
    }

    function list(Request $requests) {
        $status = !empty(request()->input('status')) ? $requests->input('status') : 'active';
        $list_act = [
            "pass_test" => "Đã kiểm tra",
            "testing" => "Chưa kiểm tra",
            "delete" => "Xoá tạm thời",
        ];

        $key_word = "";

        if ($requests->input("key_word")) {
            $key_word = $requests->input("key_word");
        }
        if ($status == "active") {
            $materials = Material::withoutTrashed()->where("material_name", "LIKE", "%{$key_word}%")->Paginate(20);
        } else if ($status == "pass_test") {
            $list_act = [
                "testing" => "Chưa kiểm tra",
                "delete" => "Xoá tạm thời",
            ];
            $materials = Material::withoutTrashed()->where("material_status", "pass_test")->where("material_name", "LIKE", "%{$key_word}%")->Paginate(20);
        } else if ($status == "testing") {
            $list_act = [
                "pass_test" => "Đã kiểm tra",
                "delete" => "Xoá tạm thời",
            ];
            $materials = Material::withoutTrashed()->where("material_status", "testing")->where("material_name", "LIKE", "%{$key_word}%")->Paginate(20);
        } else if ($status == "trashed") {
            $list_act = [
                "restore" => "Khôi phục",
                "delete_permanently" => "Xoá vĩnh viễn",
            ];
            $materials = Material::onlyTrashed()->where("material_name", "LIKE", "%{$key_word}%")->Paginate(20);
        }

        $count_material = $materials->total();
        $cnt_material_active = Material::withoutTrashed()->count();
        $cnt_material_pass_test = Material::withoutTrashed()->where("material_status", "pass_test")->count();
        $cnt_material_testing = Material::withoutTrashed()->where("material_status", "testing")->count();
        $cnt_material_trashed = Material::onlyTrashed()->count();
        $count_material_status = [$cnt_material_active, $cnt_material_pass_test, $cnt_material_testing, $cnt_material_trashed];

        // Truyền các role:
        return view("admin.material.list", compact('materials', "count_material", "count_material_status", "list_act"));
    }

    public function add()
    {
        return view('admin.material.add');
    }

    public function store(Request $requests)
    {
        if ($requests->input('btn_add')) {
            $material_name = $requests->input('material_name');
            $requests->validate(
                [
                    'material_name' => ['required', 'string', 'max:255'],
                    'material_desc' => ['required',],
                    'material_thumb' =>  ['required', 'file', "mimes:jpeg,png,jpg,gif", 'max:21000'],
                    'qty_import' => ['required', 'numeric', 'min:0'],
                    'qty_broken' => ['required', 'numeric', 'min:0'],
                    'price_import' => ['required', 'numeric', 'min:0'],
                    'date_import' => ['date', 'required'],
                    'unit_of_measure' => ['required', 'string', 'max:300'],
                ],
                [
                    'required' => ":attribute không được để trống",
                    "max" => [
                        "numeric" => ":attribute không được lớn hơn :max.",
                        "file" => ":attribute không được nhiều hơn :max KB.",
                        "string" => ":attribute không được nhiều hơn :max kí tự.",
                        "array" => ":attribute không được nhiều hơn :max mục.",
                    ],
                    "min" => [
                        "numeric" => ":attribute không được bé hơn :min.",
                        "file" => ":attribute không được ít hơn :min KB.",
                        "string" => ":attribute không được ít hơn :min kí tự.",
                        "array" => ":attribute phải có ít nhất :min mục.",
                    ],
                ],
                [
                    "material_name" => "Tên vật tư",
                    "material_desc" => "Mô tả vật tư",
                    "material_thumb" => "Hình ảnh vật tư",
                    'qty_import' => "Số lượng vật tư nhập",
                    'qty_broken' => "Số lượng vật tư hỏng",
                    'price_import' => "Giá nhập vật tư",
                    'date_import' => "Ngày nhập vật tư",
                    'unit_of_measure' => "Đơn vị quy đổi",
                ]
            );

            $material_name = $requests->input("material_name");
            $qty_import = $requests->input("qty_import");
            $qty_broken = $requests->input("qty_broken");
            $qty_remain = $qty_import - $qty_broken;
            $material = Material::create([
                'material_name' => $material_name,
                'material_desc' => $requests->input("material_desc"),
                'qty_import' => $qty_import,
                'qty_broken' => $qty_broken,
                'qty_remain' => $qty_remain,
                'price_import' => $requests->input("price_import"),
                'date_import' => $requests->input("date_import"),
                'unit_of_measure' => $requests->input("unit_of_measure"),
                'material_status' => "testing",
            ]);

            if ($requests->hasFile("material_thumb")) {
                $file = $requests->material_thumb;
                $file_name = $file->getClientOriginalName();

                $file_ext = $file->getClientOriginalExtension();

                $file_size = $file->getSize();

                $path = $file->move("public/uploads", $file->getClientOriginalName());

                $thumbnail = "public/uploads/" . $file_name;
            }

            $material_id = $material->id;
            Image::create([
                'image_link' => $thumbnail,
                'rank' => "1",
                'material_id' => $material_id,
            ]);

            return redirect("admin/material/list")->with("status", "Đã thêm vật tư có tên {$material_name} thành công");
        }
    }

    public function edit($id)
    {
        $material = Material::find($id);
        $list_stages = Stage::all();
        return view('admin.material.edit', compact("material", "list_stages"));
    }

    public function update(Request $requests, $id)
    {
        if ($requests->input('btn_update')) {
            $material_name = $requests->input("material_name");
            $requests->validate(
                [
                    'material_name' => ['required', 'string', 'max:255'],
                    'material_desc' => ['required',],
                    // 'material_thumb' =>  ['required', 'file', "mimes:jpeg,png,jpg,gif", 'max:21000'],
                    'qty_import' => ['required', 'numeric', 'min:0'],
                    'qty_broken' => ['required', 'numeric', 'min:0'],
                    'price_import' => ['required', 'numeric', 'min:0'],
                    // 'stage' => ['required'],
                    // 'date_import' => ['required'],
                    'unit_of_measure' => ['required', 'string', 'max:300'],
                ],
                [
                    'required' => ":attribute không được để trống",
                    "max" => [
                        "numeric" => ":attribute không được lớn hơn :max.",
                        "file" => ":attribute không được nhiều hơn :max KB.",
                        "string" => ":attribute không được nhiều hơn :max kí tự.",
                        "array" => ":attribute không được nhiều hơn :max mục.",
                    ],
                    "min" => [
                        "numeric" => ":attribute không được bé hơn :min.",
                        "file" => ":attribute không được ít hơn :min KB.",
                        "string" => ":attribute không được ít hơn :min kí tự.",
                        "array" => ":attribute phải có ít nhất :min mục.",
                    ],
                ],
                [
                    "material_name" => "Tên vật tư",
                    "material_desc" => "Mô tả vật tư",
                    // "material_thumb" => "Hình ảnh vật tư",
                    'qty_import' => "Số lượng vật tư nhập",
                    'qty_broken' => "Số lượng vật tư hỏng",
                    'price_import' => "Giá nhập vật tư",
                    'date_import' => "Ngày nhập vật tư",
                    'stage' => "Công đoạn",
                    'unit_of_measure' => "Đơn vị quy đổi",
                ]
            );

            Material::where('id', $id)->update([
                'material_name' => $material_name,
                'material_desc' => $requests->input("material_desc"),
                'qty_import' => $requests->input("qty_import"),
                'qty_broken' => $requests->input("qty_broken"),
                'price_import' => $requests->input("price_import"),
                'date_import' => $requests->input("date_import"),
                'unit_of_measure' => $requests->input("unit_of_measure"),
                'material_status' => $requests->input("status"),
                'stage_id' => $requests->input("stage"),
            ]);



            // if ($requests->hasFile("material_thumb")) {
            //     $file = $requests->material_thumb;
            //     $file_name = $file->getClientOriginalName();

            //     $file_ext = $file->getClientOriginalExtension();

            //     $file_size = $file->getSize();

            //     $path = $file->move("public/uploads", $file->getClientOriginalName());

            //     $thumbnail = "public/uploads/" . $file_name;
            // }
                
            // Image::where("material_id", $id)->update([
            //     'rank' => "0",
            // ]);

            // Image::create([
            //     'image_link' => $thumbnail,
            //     'rank' => "1",
            //     'material_id' => $id,
            // ]);

            return redirect("admin/material/list")->with("status", "Đã cập nhật thông tin vật tư có tên {$material_name} thành công");
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
                        foreach ($list_checked as $id) {
                            Material::where('id', $id)->update([
                                'material_status' => "trashed",
                            ]);
                        }
                        Material::destroy($list_checked);
                        return redirect("admin/material/list")->with("status", "Bạn đã xoá tạm thời {$cnt_member} vật tư thành công!");
                    } else if ($act == "pass_test") {
                        foreach ($list_checked as $id) {
                            Material::where('id', $id)->update([
                                'material_status' => "pass_test",
                            ]);
                        }
                        return redirect("admin/material/list")->with("status", "Bạn đã đặt trạng thái đã kiểm tra {$cnt_member} vật tư thành công");
                    } else if ($act == "testing") {
                        foreach ($list_checked as $id) {
                            Material::where('id', $id)->update([
                                'material_status' => "testing",
                            ]);
                        }
                        return redirect("admin/material/list")->with("status", "Bạn đã đặt trạng thái chưa kiểm tra {$cnt_member} vật tư thành công");
                    } else if ($act == "delete_permanently") {
                        Material::onlyTrashed()
                            ->whereIn("id", $list_checked)
                            ->forceDelete();
                        return redirect("admin/material/list")->with("status", "Bạn đã xoá vĩnh viễn {$cnt_member} vật tư thành công");
                    } else if ($act == "restore") {
                        Material::onlyTrashed()
                            ->whereIn("id", $list_checked)
                            ->restore();
                        foreach ($list_checked as $id) {
                            Material::where('id', $id)->update([
                                'material_status' => "testing",
                            ]);
                        }
                        return redirect("admin/material/list")->with("status", "Bạn đã khôi phục {$cnt_member} vật tư thành công");
                    }
                } else {
                    return redirect()->back()->with("status", "Không tìm thấy vật tư nào!");
                }
            } else {
                return redirect()->back()->with("status", "Bạn chưa chọn vật tư nào để thực hiện hành động!");
            }
        } else {
            return redirect()->back()->with("status", "Bạn chưa chọn hành động nào để thực hiện!");
        }
    }

    public function delete($id)
    {
        $material = Material::withTrashed()->find($id);
        $material_name = $material->material_name;

        if (empty($material->deleted_at)) {
            Material::where('id', $id)->update([
                'material_status' => "trashed",
            ]);
            $material->delete();
            return redirect()->back()->with("status", "Bạn đã xoá tạm thời vật tư có tên {$material_name} thành công");
        } else {
            $material->forceDelete();
            return redirect()->back()->with("status", "Bạn đã xoá vĩnh viễn vật tư có tên {$material_name} thành công");
        }

    }

    public function restore($id)
    {
        $material = Material::withTrashed()->find($id);
        $material_name = $material->material_name;
        $material->restore();
        Material::where('id', $id)->update([
            'material_status' => "testing",
        ]);
        return redirect("admin/material/list")->with("status", "Bạn đã khôi phục vật tư có tên {$material_name} thành công");

    }
}


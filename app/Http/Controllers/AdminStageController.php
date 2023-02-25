<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stage;

class AdminStageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => "stage"]);
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
            $stages = Stage::onlyTrashed()->where("stage_name", "LIKE", "%{$key_word}%")->orderBy("order")->orderByDesc("created_at")->Paginate(20);
        } else {
            $stages = Stage::withoutTrashed()->where("stage_name", "LIKE", "%{$key_word}%")->orderBy("order")->orderByDesc("created_at")->Paginate(20);
        }

        $count_stage = $stages->total();
        $cnt_stage_active = Stage::withoutTrashed()->count();
        $cnt_stage_trashed = Stage::onlyTrashed()->count();
        $count_stage_status = [$cnt_stage_active, $cnt_stage_trashed];
        return view("admin.stage.list", compact('stages', "count_stage", "count_stage_status", "list_act"));
    }

    public function add()
    {
        $stages = Stage::all();
        return view('admin.stage.add', compact("stages"));
    }

    public function store(Request $requests)
    {
        if ($requests->input('btn_add')) {
            $requests->validate(
                [
                    'stage_name' => ['required', 'string', 'max:300'],
                    'stage_detail' => ['required',],
                    'order' => ['required', 'numeric', 'min:0'],
                ],
                [
                    'required' => ":attribute không được để trống",
                    'max' => ":attribute có độ dài ít nhất :max ký tự",
                ],
                [
                    "stage_name" => "Tên công đoạn",
                    "stage_detail" => "Chi tiết công đoạn",
                    "order" => "Thứ tự",
                ]
            );

            $stage_name = $requests->input("stage_name");
// dd($requests->input("order"));
            Stage::create([
                'stage_name' => $stage_name,
                'stage_detail' => $requests->input("stage_detail"),
                'order' => $requests->input("order"),
            ]);

            return redirect("admin/stage/list")->with("status", "Đã thêm công đoạn tên {$stage_name} thành công");
        }
    }

    public function edit($id)
    {
        $stages = Stage::all();
        $stage = Stage::find($id);

        return view("admin.stage.edit", compact("stage", "stages"));
    }

    public function update(Request $requests, $id)
    {
        if ($requests->input('btn_update')) {
            $requests->validate(
                [
                    'stage_name' => ['required', 'string', 'max:300'],
                    'stage_detail' => ['required'],
                    'order' => ['required', 'numeric', 'min:1'],
                ],
                [
                    'required' => ":attribute không được để trống",
                    'max' => ":attribute có độ dài ít nhất :max ký tự",
                ],
                [
                    "stage_name" => "Tên công đoạn",
                    "stage_detail" => "Chi tiết công đoạn",
                    "order" => "Thứ tự",
                ]
            );

            $stage_name = $requests->input("stage_name");

            Stage::where('id', $id)->update([
                'stage_name' => $stage_name,
                'stage_detail' => $requests->input("stage_detail"),
                'order' => $requests->input("order"),
            ]);

            return redirect("admin/stage/list")->with("status", "Đã cập nhật thông tin công đoạn tên {$stage_name} thành công");
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
                        Stage::destroy($list_checked);
                        return redirect("admin/stage/list")->with("status", "Bạn đã xoá tạm thời {$cnt_member} công đoạn thành công!");
                    } else if ($act == "delete_permanently") {
                        Stage::onlyTrashed()
                            ->whereIn("id", $list_checked)
                            ->forceDelete();
                        return redirect()->back()->with("status", "Bạn đã xoá vĩnh viễn {$cnt_member} công đoạn thành công");
                    } else if ($act == "restore") {
                        Stage::onlyTrashed()
                            ->whereIn("id", $list_checked)
                            ->restore();
                        return redirect("admin/stage/list")->with("status", "Bạn đã khôi phục {$cnt_member} công đoạn thành công");
                    }
                } else {
                    return redirect()->back()->with("status", "Không tìm thấy công đoạn nào!");
                }
            } else {
                return redirect()->back()->with("status", "Bạn chưa chọn công đoạn nào để thực hiện hành động!");
            }
        } else {
            return redirect()->back()->with("status", "Bạn chưa chọn hành động nào để thực hiện!");
        }
    }

    public function delete($id)
    {
        $stage = Stage::withTrashed()->find($id);
        $stage_name = $stage->stage_name;

        if (empty($stage->deleted_at)) {
            $stage->delete();
            return redirect()->back()->with("status", "Bạn đã xoá tạm thời công đoạn tên {$stage_name} thành công");
        } else {

            $stage->forceDelete();
            return redirect()->back()->with("status", "Bạn đã xoá vĩnh viễn công đoạn tên {$stage_name} thành công");
        }
    }

    public function restore($id)
    {
        $stage = Stage::withTrashed()->find($id);
        $stage_name = $stage->stage_name;
        $stage->restore();
        return redirect("admin/stage/list")->with("status", "Bạn đã khôi phục công đoạn tên {$stage_name} thành công");
    }

}


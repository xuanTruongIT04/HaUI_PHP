<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProductionPlantController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => "product"]);
            return $next($request);
        });
    }

    function list(){
        return view('admin.productionPlan.list');
    }
}

// function cnt_congnhan($id_bophan) {
//         $cnt = CongNhan::where("mabophan", $id_bophan) -> count();
//         return $cnt;
// }

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\facades\DataTables;

class Userdatas extends Controller
{
    public function getlist(Request $request){

        $model = DB::table('users')->get();
        return DataTables::of($model)
                    ->addColumn('action', '<button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">View</button>
')
                    ->rawColumns(['action'])
                    ->toJson();
    }
}

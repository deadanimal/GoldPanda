<?php

namespace App\Http\Controllers;

use DataTables;
use DateTime;
use Carbon\Carbon;

use RealRashid\SweetAlert\Facades\Alert;


use Illuminate\Http\Request;
use App\Models\Flow;

class FlowController extends Controller
{
    public function home(Request $request) {
        $user_id = auth()->user()->id;
        $flows = Flow::where('user_id', $user_id)->get();
        if ($request->ajax()) {
            return DataTables::collection($flows)
                ->addIndexColumn()
                ->make(true);
        } else {
            return view('flow.home', compact('flows'));
        }        
    }

    public function satu(Request $request) {
        $id = (int)$request->route('id');
        $flow = Flow::find($id);
        return view('flow.satu', compact('flow'));
    }
}

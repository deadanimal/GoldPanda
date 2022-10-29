<?php

namespace App\Http\Controllers;

use DataTables;
use DateTime;
use Carbon\Carbon;
use Alert;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use App\Models\Profile;
use App\Models\User;


class ProfileController extends Controller
{

    public function home(Request $request)
    {
        $user_id = $request->user()->id;
        $user = User::find($user_id);
        return view('profile.home', compact('user'));
    }

    public function admin(Request $request)
    {
        $users = User::all();
        if ($request->ajax()) {
            return DataTables::collection($users)
                ->addIndexColumn()
                ->addColumn('name', function (user $user) {
                    $html_button = $user->name;
                    return $html_button;
                })                 
                ->addColumn('mobile', function (user $user) {
                    $html_statement = $user->mobile;
                    return $html_statement;
                })      
                ->addColumn('balance', function (user $user) {
                    $html_statement = $user->balance;
                    return $html_statement;
                })   
                ->addColumn('advanced', function (user $user) {
                    $html_statement = $user->advanced;
                    return $html_statement;
                })  
                ->addColumn('booked', function (user $user) {
                    $html_statement = $user->booked;
                    return $html_statement;
                })  
                ->addColumn('reward', function (user $user) {
                    $html_statement = $user->reward;
                    return $html_statement;
                })                                                                                          
                ->rawColumns([ 'name', 'mobile', 'balance', 'advanced', 'booked', 'reward'])
                ->make(true);
        } else {
            return view('profile.admin');
        }
    }

    public function satu(Request $request)
    {
        $id = (int)$request->route('id');
        $user = User::find($id);
        return view('profile.satu', compact('user'));
    }

    public function change_password(Request $request) {
        $user = $request->user();
        $request->validate([
            'new_password' => ['required', Rules\Password::defaults()],
        ]);
        $user->password = Hash::make($request->new_password);        
        Alert::success('Password', 'Your password has been successfully changed');
        $user->save();
        
        return back();
        
    }        
}

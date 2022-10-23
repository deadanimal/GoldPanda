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

    public function admin_home(Request $request)
    {
        return view('profile.admin_home');
    }

    public function satu_user(Request $request)
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

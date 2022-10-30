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
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;

use App\Models\Profile;
use App\Models\User;


class ProfileController extends Controller
{

    public function home(Request $request) {
        $user_id = $request->user()->id;
        $user = User::find($user_id);
        return view('profile.home', compact('user'));
    }

    public function admin(Request $request) {
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

    public function satu(Request $request) {
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

    public function daftar(Request $request) {
        $code = $request->route('code');
        if (User::where('code', $code)->exists()) {            
            $promoter = User::where('code', $code)->first();       
        } else {
            $promoter = User::where('code', 'SAUFIA')->first(); 
            Alert::error('No Code Found', 'System is unable to find the registration code so system chose random consultant');           
        }
        return view('profile.daftar', compact('promoter'));
    }

    public function cipta(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'code' => ['required', 'string', 'max:6'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (User::where('code', $request->code)->exists()) {
            $promoter = User::where('code', $request->code)->first();
        } else {
            Alert::error('No Code Found', 'System is unable to find the registration code. Please try to register again');
            return back();
        }        

        $promoter = User::where('id', $promoter->introducer_id)->first();


        $new_level = $promoter->level + 1;
        if ($new_level > 5) {
            Alert::error('Maximum Level Reached', 'The consultant code is unable to be used. Please find a different consultant');
            return back();
        } else {
            $code = $this->generate_unique_code();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);        

        $user->level = $new_level;
        $user->introducer_id = $promoter->id;
        $user->code = $code;
        $user->mobile = '+6'.$request->mobile;
        $user->save();        

        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }    
    
    public function generate_unique_code() {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;

        $code = '';

        while (strlen($code) < $codeLength) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code . $character;
        }

        if (User::where('code', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;
    }
}

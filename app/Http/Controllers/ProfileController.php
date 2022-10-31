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

use App\Models\Reward;
use App\Models\Profile;
use App\Models\User;


class ProfileController extends Controller
{

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
                ->addColumn('link', function (user $user) {
                    $url = '/admin/user/'.$user->id;
                    $html_button = '<a href="' . $url . '"><button class="btn btn-primary">View</button></a>';
                    return $html_button;
                })                                                                                            
                ->rawColumns([ 'name', 'mobile', 'link'])
                ->make(true);
        } else {
            return view('profile.admin');
        }
    }

    public function agent(Request $request) {
        $user = $request->user();
        $users = User::where('introducer_id', $user->id)->get();

        // $first_level_agents = User::where('introducer_id', $user->id)->count();
        // $second_level_agents = User::where('introducer_id.introducer_id', $user->id)->count();

        $all_agent_cumulative = Reward::where('introducer_id', $user->id)->sum('amount');
        $first_agent_cumulative = Reward::where([
            ['introducer_id','=', $user->id],
            ['level','=', 1],
        ])->sum('amount');
        $second_agent_cumulative = Reward::where([
            ['introducer_id','=', $user->id],
            ['level','=', 2],
        ])->sum('amount');
        $third_agent_cumulative = Reward::where([
            ['introducer_id','=', $user->id],
            ['level','=', 3],
        ])->sum('amount');

        $all_agent_monthly = Reward::where([
            ['introducer_id', '=', $user->id],
            ['created_at', 'like', Carbon::now()->format("Y-m")."%"]
        ])->sum('amount');
        $first_agent_monthly = Reward::where([
            ['introducer_id', '=', $user->id],
            ['level','=', 1],
            ['created_at', 'like', Carbon::now()->format("Y-m")."%"]
        ])->sum('amount');  
        $second_agent_monthly = Reward::where([
            ['introducer_id', '=', $user->id],
            ['level','=', 2],
            ['created_at', 'like', Carbon::now()->format("Y-m")."%"]
        ])->sum('amount'); 
        $third_agent_monthly = Reward::where([
            ['introducer_id', '=', $user->id],
            ['level','=', 3],
            ['created_at', 'like', Carbon::now()->format("Y-m")."%"]
        ])->sum('amount');                         



        $data = (object) array(
            'all_agent_cumulative' => $all_agent_cumulative,
            'first_agent_cumulative' => $first_agent_cumulative,
            'second_agent_cumulative' => $second_agent_cumulative,
            'third_agent_cumulative' => $third_agent_cumulative,
            'all_agent_monthly' => $all_agent_monthly,
            'first_agent_monthly' => $first_agent_monthly,
            'second_agent_monthly' => $second_agent_monthly,
            'third_agent_monthly' => $third_agent_monthly,            
        );
        if ($request->ajax()) {
            return DataTables::collection($users)
                ->addIndexColumn()
                ->addColumn('name', function (User $user) {
                    $html_button = $user->name;
                    return $html_button;
                })     
                ->addColumn('identity', function (User $user) {
                    if($user->ic_verified) {
                        $html_button = '<span class="badge rounded-pill bg-success">Verified</span>';
                    } else {
                        $html_button = '<span class="badge rounded-pill bg-danger">Unverified</span>';
                    }
                    return $html_button;
                })  
                ->addColumn('bank_account', function (User $user) {
                    if($user->bank_account_verified) {
                        $html_button = '<span class="badge rounded-pill bg-success">Verified</span>';
                    } else {
                        $html_button = '<span class="badge rounded-pill bg-danger">Unverified</span>';
                    }
                    return $html_button;
                })                                              
                ->addColumn('mobile', function (User $user) {
                    $html_statement = $user->mobile;
                    return $html_statement;
                })    
                ->addColumn('cum_sales', function (User $user) {                    
                    $amount = Reward::where([
                        ['introducer_id','=', $user->id],
                        ['level','=', 1],
                    ])->sum('amount');   
                    $html_statement = 'RM '.number_format((int)($amount)  / 100, 2, '.', ',');
                    return $html_statement;
                })     
                ->addColumn('cum_downlines', function (User $user) {
                    $amount1 = Reward::where([
                        ['introducer_id','=', $user->id],
                        ['level','=', 2],
                    ])->sum('amount');  
                    $amount2 = Reward::where([
                        ['introducer_id','=', $user->id],
                        ['level','=', 3],
                    ])->sum('amount');                        
                    $html_statement = 'RM '.number_format((int)($amount1+$amount2)  / 100, 2, '.', ',');
                    return $html_statement;
                })    
                ->addColumn('monthly_sales', function (User $user) {                    
                    $amount = Reward::where([
                        ['introducer_id','=', $user->id],
                        ['level','=', 1],
                        ['created_at', 'like', Carbon::now()->format("Y-m")."%"]
                    ])->sum('amount');   
                    $html_statement = 'RM '.number_format((int)($amount)  / 100, 2, '.', ',');
                    return $html_statement;
                })     
                ->addColumn('monthly_downlines', function (User $user) {
                    $amount1 = Reward::where([
                        ['introducer_id','=', $user->id],
                        ['level','=', 2],
                        ['created_at', 'like', Carbon::now()->format("Y-m")."%"]
                    ])->sum('amount');  
                    $amount2 = Reward::where([
                        ['introducer_id','=', $user->id],
                        ['level','=', 3],
                        ['created_at', 'like', Carbon::now()->format("Y-m")."%"]
                    ])->sum('amount');                        
                    $html_statement = 'RM '.number_format((int)($amount1+$amount2)  / 100, 2, '.', ',');
                    return $html_statement;
                })                                                  
                ->addColumn('link', function (User $user) {
                    $url = '/user/'.$user->id;
                    $html_button = '<a href="' . $url . '"><button class="btn btn-primary">View</button></a>';
                    return $html_button;
                })                                                                                            
                ->rawColumns([ 'name', 'mobile', 'link', 'identity', 'bank_account', 'cum_sales', 'cum_downlines', 'monthly_sales', 'monthly_downlines'])
                ->make(true);
        } else {
            return view('profile.senarai_agent', compact('data', 'user'));
        }
    }    

    public function satu(Request $request) {
        $currrent_user = $request->user();
        $id = (int)$request->route('id');
        if($id) {
            $user = User::find($id);
        } else {
            $user = User::find($currrent_user->id);
        }
        return view('profile.satu', compact('user'));
    }

    public function satu_agent(Request $request) {
        $currrent_user = $request->user();
        $id = (int)$request->route('id');
        $user = User::where([
            ['id', '=', $id],
            ['introducer_id', '=', $currrent_user->id]
        ])->first();
        return view('profile.satu_agent', compact('user'));
    }       

    public function kemaskini(Request $request) {
        $currrent_user = $request->user();
        $id = (int)$request->route('id');
        if($currrent_user->hasRole('super-admin') && $id) {
            $user = User::find($id);
            $user->ic = $request->ic;
            $user->ic_verified = true;
            $user->ic_verified_at = now();   
            $user->mobile = $request->mobile;
            $user->mobile_verified = true;
            $user->mobile_verified_at = now();    
            $user->bank_account_name = $request->bank_account_name;
            $user->bank_account_number = $request->bank_account_number;
            $user->bank_account_verified = true;
            $user->bank_account_verified_at = now(); 
            $user->save();                               
        } else {
            $user = User::find($currrent_user->id);
        }
        return view('profile.satu', compact('user'));
    }    

    public function sah_pengguna(Request $request) {
        $currrent_user = $request->user();
        $id = (int)$request->route('id');
    }

    public function sah_bank(Request $request) {}

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

    public function kemaskini_password(Request $request) {
        $currrent_user = $request->user();
        $id = (int)$request->route('id');
        $user = User::find($id);
        $request->validate([
            'new_password' => ['required', Rules\Password::defaults()],
        ]);
        $user->password = Hash::make($request->new_password);        
        Alert::success('Password', "User's password has been successfully changed");
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
            'nric' => ['required', 'string'],
            'mobile' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $promoter = User::where('code', $request->code)->first();

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
        $user->ic = $request->nric;
        $user->mobile = '+6'.$request->mobile;
        $user->save();        

        event(new Registered($user));
        Auth::login($user);
        Alert::success('User Registered', "You have been registered on the system. Please contact us to verify your account");
        return redirect('/dashboard');
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

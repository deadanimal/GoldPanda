<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\RewardProfile;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $code = $request->code;
        return view('auth.register', compact('code'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'code' => ['required', 'string', 'max:6'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (RewardProfile::where('code', $request->code)->exists()) {
            $promoter_profile = RewardProfile::where('code', $request->code)->first();
        } else {
            $promoter_profile = RewardProfile::where('code', 'SAUFIA')->first();
        }        

        $promoter = User::where('id', $promoter_profile->user_id)->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $new_level = $promoter_profile->level + 1;
        if ($new_level > 3) {
            $code = $promoter_profile->code;
        } else {
            $code = $this->generateUniqueCode();
        }

        $reward_profile = new RewardProfile;
        $reward_profile->level = $new_level;
        $reward_profile->user_id = $user->id;
        $reward_profile->promoter_id = $promoter->id;
        $reward_profile->code = $code;
        $reward_profile->save();        

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function generateUniqueCode()
    {
    
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;
    
        $code = '';
    
        while (strlen($code) < 6) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }
    
        if (RewardProfile::where('code', $code)->exists()) {
            $this->generateUniqueCode();
        }
    
        return $code;
    
    }        
}

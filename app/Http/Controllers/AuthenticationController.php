<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite as Socialite;
use App\User;
use Auth;


use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function facebookCallback()
    {
        try{
            $facebook = Socialite::driver('facebook')->stateless()->user();
        }
        catch(Exception $e){
            return redirect('/');
        }
        if($facebook->getEmail() == null){
            return redirect('/register')->with('status', 'your facebook account has no email');
        }
        $user = User::where('email', $facebook->getEmail())->first();
        if(!$user){
            $users = User::create([
            'name' => $facebook->getName(),
            'email' => $facebook->getEmail(),
            'type' => 'user',
            ]);
        }else{
            return redirect('/register')->with('status', 'email has already been taken');
        }
        auth::login($users);
        return view('pages.createPassword');
    }

    public function getLogin() {
        return Socialite::driver('facebook')->redirect();
    }

    public function createPassword(Request $request) {
         
         User::where('id', Auth()->user()->id)->update(['password' => bcrypt($request->password)]);
         return redirect('/home')->with('status', 'Welcome to blackmotion');
        
    }
}
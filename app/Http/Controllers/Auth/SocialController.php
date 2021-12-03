<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function redirectGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function processGoogleLogin(){
        $googleUser = Socialite::driver('google')->user();  // kiểm tra cho phép hay không
        if(!$googleUser){
            return redirect('/login');  // Nếu không cho phép trả về login
        }

        $systemUser = User::firstOrCreate(
            // kiểm tra xem google_id đã có hay chưa // Nếu chưa thấy thì gộp hết vào db
            ['google_id'=> $googleUser->id],  
            ['name'=>$googleUser->name,
             'username'=>'google_'.$googleUser->id, 
             'email'=>$googleUser->email,
            ]
        );

        // Nếu có thì cho đăng nhập
        Auth::loginUsingId($systemUser->id);
        return redirect('/home');    
    }
}

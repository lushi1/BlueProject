<?php

namespace App\Http\Controllers;
use Socialite;
use Auth;
use Exception;
use App\taikhoan;
use Illuminate\Http\Request;

class LoginGoogleAccount extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
      
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
            $finduser = taikhoan::where('google_id', $user->id)->first();
     
            if($finduser){    
                
                return view('pages.dashboard');
     
            }
            else{
                $newUser = taikhoan::create([   
                    'loaitaikhoan' => '1',                
                    'tentaikhoan' => $user->email,
                    'google_id'=> $user->id,
                    'matkhau' => encrypt('123456dummy'),
                    
                ]);

                // $taikhoan = new taikhoan();
                // $taikhoan->tentaikhoan = $user->email;
                // $taikhoan->matkhau = $user->id;
                // $taikhoan->loaitaikhoan = '0';
                // $taikhoan->google_id = $user->id;
                // $taikhoan->save();
                return view('pages.dashboard');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}

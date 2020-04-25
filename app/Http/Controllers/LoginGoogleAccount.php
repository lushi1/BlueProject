<?php

namespace App\Http\Controllers;
use Socialite;
use Auth;
use Hash;
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
                
                return redirect('trang-chu');
     
            }
            else{
                $newUser = taikhoan::create([   
                    'loaitaikhoan' => '1',                
                    'tentaikhoan' => $user->email,
                    'google_id'=> $user->id,
                    'matkhau' => Hash::make('123'),
                    
                ]);               
                return redirect('trang-chu');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        // Redirect facebook API;
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
            // Get User From the Facebook;
            $user = Socialite::driver('facebook')->stateless()->user();
            // find the  User From the Facebook Id;
            $finduser = User::where('facebook_id', $user->id)->first();

            if($finduser){

                // If User exists user redirect to the dashboard with user details;
                Auth::login($finduser);

                return redirect()->intended('dashboard');

            }else{
                // Create  new user and redirect to the dashboard with user details;

                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'avatar' => $user->avatar,
                        'facebook_id'=> $user->id,
                        'password' => encrypt('123456dummy')
                    ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }

        } catch (Exception $e) {
            // Print Error;
            dd($e->getMessage());
        }
    }
}

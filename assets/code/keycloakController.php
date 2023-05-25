<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Exception;
use Socialite;
use App\Models\User;

class KeyCloakController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('keycloak')->redirect();
    }

    public function callback()
    {
        $remote_user = Socialite::driver('keycloak')->stateless()->user();
        $user = User::updateOrCreate([
            'keycloak_id' => $remote_user->id,
        ], [
            'firstname' => $remote_user->user['given_name'],
            'lastname' => $remote_user->user['family_name'],
            'email' => $remote_user->email,
            'gender'=>$remote_user->user['gender'],
            'affiliation'=>$remote_user->user['affiliation'],
            'unique_id'=> $remote_user->user['unique_id'],
            'remember_token' => $remote_user->refreshToken,
        ]);

        Auth::login($user);
        return redirect(session()->get('url.intended', '/api'));
    }

    public function login(Request $request)
    {
        $url = $request->input('redirect');
        session()->put('url.intended', $url);
        return Socialite::driver('keycloak')->redirect();
    }

    [...]
}
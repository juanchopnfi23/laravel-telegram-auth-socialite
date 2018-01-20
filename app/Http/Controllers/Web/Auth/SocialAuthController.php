<?php
namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use Socialite;
use Auth;
use App\User;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        //return Socialite::driver('github')->redirect();
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        // Obtenemos los datos del usuario
        $social_user = Socialite::driver($provider)->user(); 
        // Comprobamos si el usuario ya existe
        if ($user = User::where('email', $social_user->email)->first()) { 
            return $this->authAndRedirect($user); // Login y redirección
        } 
        // En caso de que no exista creamos un nuevo usuario con sus datos.
        $user = User::create([
            'name' => $social_user->name,
            'email' => $social_user->email,
            'avatar' => $social_user->avatar
        ]);
 
        return $this->authAndRedirect($user); // Login y redirección
    }

    // Login y redirección
    public function authAndRedirect($user){
        Auth::login($user);
 
        return redirect()->to('/home');
    }
}
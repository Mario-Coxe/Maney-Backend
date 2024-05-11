<?php
namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class OAuthController extends Controller
{

public function redirectToFacebookProvider()
{
    return Socialite::driver('facebook')->redirect();
}

public function handleFacebookProviderCallback()
{
    $user = Socialite::driver('facebook')->user();

    // Verifica se o usuário já está cadastrado na aplicação
    $existingUser = User::where('email', $user->getEmail())->first();

    if ($existingUser) {
        // Autentica o usuário existente
        auth()->login($existingUser);
    } else {
        // Cria um novo usuário na aplicação
        $newUser = User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => Hash::make(Str::random(20)),
        ]);

        auth()->login($newUser);
    }

    return redirect()->intended('/dashboard');
}

public function redirectToGoogleProvider()
{
    return Socialite::driver('google')->redirect();
}

public function handleGoogleProviderCallback()
{
    $user = Socialite::driver('google')->user();

    // Verifica se o usuário já está cadastrado na aplicação
    $existingUser = User::where('email', $user->getEmail())->first();

    if ($existingUser) {
        // Autentica o usuário existente
        auth()->login($existingUser);
    } else {
        // Cria um novo usuário na aplicação
        $newUser = User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => Hash::make(Str::random(20)),
        ]);

        auth()->login($newUser);
    }

    return redirect()->intended('/');
}

public function socialLogin(Request $request)
{
    $provider = $request->input('provider_name'); //for multiple providers
    $token = $request->input('access_token');
    // get the provider's user. (In the provider server)
    $providerUser = Socialite::driver($provider)->userFromToken($token);
    // check if access token exists etc..
    // search for a user in our server with the specified provider id and provider name
    $user = User::where('social_provider', $provider)->where('provider_id', $providerUser->id)->first();
    // if there is no record with these data, create a new user
    if($user == null){
        $user = User::create([
            'provider_name' => $provider,
            'provider_id' => $providerUser->id,
        ]);
    }
    // create a token for the user, so they can login
    $token = $user->createToken(env('APP_NAME'))->accessToken;
    // return the token for usage
    return json_encode([
        'success' => true,
        'token' => $token
    ]);
}

}

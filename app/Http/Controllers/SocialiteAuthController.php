<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialiteAuthController extends Controller
{
    public function handleGovbrCallback()
    {
        $socialUser = Socialite::driver('govbr')->user();

        // Localizar ou criar um usuário no banco de dados
        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName(),
                // Adicione outros campos necessários
            ]
        );

        // Autenticar o usuário
        Auth::login($user);

        // Redirecionar para o painel do Filament
        return redirect()->route('filament.pages.dashboard');
    }
}

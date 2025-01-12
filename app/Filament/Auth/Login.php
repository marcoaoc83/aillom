<?php

namespace App\Filament\Auth;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;
use Filament\Http\Responses\Auth\LoginResponse;
use Filament\Pages\Auth\Login as BaseAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends BaseAuth
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getLoginFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getLoginFormComponent(): Component
    {
        return TextInput::make('login')
            ->label('Login')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        $login_type = filter_var($data['login'], FILTER_VALIDATE_EMAIL ) ? 'email' : 'login';

        return [
            $login_type => $data['login'],
            'password'  => $data['password'],
        ];
    }

    public function authenticate(): ?LoginResponse
    {
        // Obtém os dados do formulário
        $credentials = $this->form->getState();

        // Tenta autenticar apenas com a coluna `login`
        if (!Auth::attempt(['login' => $credentials['login'], 'password' => $credentials['password']])) {
            throw ValidationException::withMessages([
                'data.login' => __('filament-panels::pages/auth/login.messages.failed'),
            ]);
        }

        // Regenera a sessão após login bem-sucedido
        session()->regenerate();

        return app(LoginResponse::class);
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.login' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'alpha', 'min:2', 'max:20'],
            'surname' => ['required', 'string', 'alpha', 'min:2', 'max:40'],
            'DNI' => ['required', 'regex:/^\d{9}[A-Za-z]$/'],
            'email' =>  ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'El nombre es obligatorio',
            'surname.required' => 'El apellido es obligatorio',
            'name.min' => 'El nombre debe tener al menos 2 caracteres',
            'name.max' => 'El nombre no puede tener más de 20 caracteres',
            'surname.min' => 'El apellido debe tener al menos 2 caracteres',
            'surname.max' => 'El apellido no puede tener más de 20 caracteres',
            'DNI.regex' => 'El DNI no tiene el formato adecuado',
            'DNI.required' => 'El DNI es obligatorio',
            'password' => 'La contraseña no cumple con los requisitos de seguridad.',
            'password.confirmed' => 'Las contraseñas no coinciden'
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'DNI' => $request->DNI,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_rep' => Hash::make($request->password_rep),
            'telefono' => $request->telefono,
            'pais' => $request->pais,
            'sobre_ti' => $request->sobre_ti,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

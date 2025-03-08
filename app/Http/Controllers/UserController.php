<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{


    public function doRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:5',
            'password_confirmation' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $datos = $request->all();
        User::create($datos);
        //Auth::login($user);
        return redirect()->route('showLogin');
    }
    public function doLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $userEmail = $request->email;
        $userPassword = $request->password;

        $userCredentials = [
            'email' => $userEmail,
            'password' => $userPassword
        ];

        if (Auth::attempt($userCredentials, true)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['email' => 'Email incorrecto', 'password' => 'Contraseña incorrecta']);
        }
    }

    public function doLogout()
    {
        Auth::logout();
        return redirect()->route('showLogin');
    }


    public function deletePerfil($id)
    {
        $user = User::findOrFail($id);
        if ($user->id == Auth::id()) {
            $user->delete();
            return redirect()->route('user.login')->with('success', 'Cuenta eliminada correctamente.');
        }
        return redirect()->route('home')->with('error', 'No tienes permisos para eliminar una cuenta ajena.');

    }
}

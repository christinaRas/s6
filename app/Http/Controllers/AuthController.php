<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function inscri()
    {
        return view('auth.inscri');
    }

    function loginPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required'
        ], [
            'login.required' => 'Le champ team name est obligatoire.',
            'password.required' => 'Le champ password est obligatoire.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        $credentials = $request->only('login', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->intended(route('dashboard'));
            } else {
                return redirect()->intended(route('listeEtape'));
            }
        }
        return redirect(route('login'))->with("error", "Login failed");
    }

    public function inscriPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'name' => 'required',
            'login' => 'required',
            'password' => 'required'
        ], [
            // 'name.required' => 'Le champ name est obligatoire.',
            'login.required' => 'Le champ login est obligatoire.',
            'login.unique' => 'Le champ login est déjà pris, veuillez en saisir un autre.',
            'password.required' => 'Le champ password est obligatoire.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = new User();
        $user->name = $request->name;
        $user->login = $request->login;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
    
        if ($user->save()) {
            return redirect()->route('login')->with('success', 'Inscription réussie. Veuillez vous connecter.');
        } else {
            return redirect()->route('inscri')->with('error', 'Erreur lors de l\'inscription. Veuillez réessayer.');
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

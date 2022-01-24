<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

//add para converter pass formato has
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserAuthControler extends Controller
{
    //login metodo
    function login()
    {
        //chamar o view login, dentro da pasta resource auth 
        return view('auth.login');
    }

    //metodo register
    function register()
    {
        return view('auth.register');
    }

    //funcao criar user
    function create(Request $request)
    {
        //validacao requests
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users', //o email na tabela users deve ser unico
            'password' => 'required|min:5|max:12'
        ]);

        //if form validated successfuly, then register new user nb: prefiro usar esse
        //alem de QUERY BUILDER
        //$user = new User;
        //$user->name = $request->name;
        //$user->email = $request->email;
        //$user->password = Hash::make($request->password);
        //$query = $user->save();

        //USE QUERY BUILDER
        $query = DB::table('users')
            ->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

        if ($query) {
            return back()->with('success', 'You have been successfuly registered');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }


    //funcao para fazer login
    function check(Request $request)
    {
        //validacao requeste
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);

        //if form validated successfully, then process login
        //$user = User::where('email', '=', $request->email)->first();
        $user = DB::table('users')
            ->where('email', $request->email)
            ->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                //if password match, then redirect user to profile
                $request->session()->put('LoggedUser', $user->id);
                return redirect('profile');
            } else {
                return back()->with('fail', 'Invail password');
            }
        } else {
            return back()->with('fail', 'No account found for this email');
        }
    }

    //profile metodo mostrar
    function profile()
    {
        if (session()->has('LoggedUser')) {
            //$user = User::where('id', '=', session('LoggedUser'))->first();
            $user = DB::table('users')
                ->where('id', session('LoggedUser'))
                ->first();
            $data = [
                'LoggedUserInfo' => $user
            ];
        }
        return view('user.profile', $data);
    }

    //logout
    function logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('/');
        }
    }
}

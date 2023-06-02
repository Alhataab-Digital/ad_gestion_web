<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Utilisateur;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $connection=$request->only('email','password');

                if(Auth::attempt($connection)){


                    $users=Utilisateur::where('email',$request->email)->get();
                    foreach($users as $user){
                        if($user->etat !=0){
                        return redirect('/home');
                        }
                        return redirect('/')->with('danger','Compte inactif');

                    }

                }
                return redirect('/')->with('danger','Login ou mots de passe invalide');

    }

    /**
     * Display the specified resource.
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

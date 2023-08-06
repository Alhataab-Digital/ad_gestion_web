<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Utilisateur;
use App\Models\ConnexionUser;
use App\Models\UserEnLigne;
use Stevebauman\Location\Facades\Location;



class LoginController extends Controller
{

    public function index(){
        return view('auth.login');
    }
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        if(Auth::check()){
        if(isset(UserEnLigne::where('utilisateur_id',Auth::user()->id)->first(['utilisateur_id'])->utilisateur_id)){
            ConnexionUser::create([
                'utilisateur_id'=>Auth::user()->id,
                'etat'=>'deconnexion',
            ]);
            $deconnexion=UserEnLigne::where('utilisateur_id',Auth::user()->id)->first();
            $deconnexion->delete('utilisateur_id',Auth::user()->id);
            Session::flush();
            Auth::logout();
        return view('auth.login');
        }
        ConnexionUser::create([
            'utilisateur_id'=>Auth::user()->id,
            'etat'=>'deconnexion',
        ]);
        Session::flush();
        Auth::logout();
        return view('auth.login');
        }
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

        if(isset(Utilisateur::where('email',$request->email)->first()->id)){
            $request->validate([
                'email'=>'required',
                'password'=>'required|min:4',
            ]);
    
            $connection=$request->only('email','password');
            $user=Utilisateur::where('email',$request->email)->first();
        if(isset(UserEnLigne::where('utilisateur_id',$user->id)->first(['utilisateur_id'])->utilisateur_id)){
            return redirect('/auth')->with('danger',"le compte est déjà en cours d'utilisation");
        }else{
            if(Auth::attempt($connection)){
                $users=Utilisateur::where('email',$request->email)->get();
                
                    if(Auth::check()){
                        foreach($users as $user){
                            if($user->etat !=0){
                                    ConnexionUser::create([
                                        'utilisateur_id'=>$user->id,
                                        'etat'=>'connexion',
                                    ]);
                                    UserEnLigne::create([
                                        'utilisateur_id'=>$user->id,
                                        'etat'=>'en ligne',
                                    ]);
                                return redirect('/home');
                                }
                            return redirect('/auth')->with('danger','Compte inactif');

                        }
                    }
                
                return redirect('/auth')->with('danger',"Session expirée");
            }
            return redirect('/auth')->with('danger','Login ou mots de passe invalide');
        }
        return redirect('/auth');
        }
        return redirect('/auth');

    }

    /**
     * Display the specified resource.
     */
    public function logout()
    {
        if(isset(Auth::user()->id)){
             $user= Auth::user()->id;

        ConnexionUser::create([
            'utilisateur_id'=>$user,
            'etat'=>'deconnexion',
        ]);
        if(isset(UserEnLigne::where('utilisateur_id',Auth::user()->id)->first()->id)){
            $deconnexion=UserEnLigne::where('utilisateur_id',Auth::user()->id)->first();
            $deconnexion->delete('utilisateur_id',Auth::user()->id);
        }
        
        Session::flush();
        Auth::logout();
        return redirect('/auth');
        }
        Session::flush();
        Auth::logout();
        return redirect('/auth');
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

    public function user_connexion()
    {
        return view('auth.deconnexion_user_encour');
    }

    public function restore_connexion(Request $request)
    {
         
        if(isset(Utilisateur::where('email',$request->email)->first()->id)){
            $user=Utilisateur::where('email',$request->email)->first();
            if(isset(UserEnLigne::where('utilisateur_id',$user->id)->first()->id))
            {
            $deconnexion=UserEnLigne::where('utilisateur_id',$user->id)->first();
            $deconnexion->delete('utilisateur_id',$user->id);
            Session::flush();
            Auth::logout();
            return redirect('/auth')->with('success','Utilisateur débloqué');
            }
            return redirect('/auth');
        }
        return redirect('/auth')->with('danger'," L'utilisateur n'est pas en cours d'utilisation");
    }
}

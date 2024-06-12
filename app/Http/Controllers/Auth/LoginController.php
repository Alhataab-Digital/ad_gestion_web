<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AlertCodeReconnexion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Users\Utilisateur;
use App\Models\Users\ConnexionUser;
use App\Models\Users\UserEnLigne;
use Illuminate\Support\Facades\Mail;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
use Stevebauman\Location\Facades\Location;

use function PHPUnit\Framework\returnSelf;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        if (Auth::check()) {
            if (isset(UserEnLigne::where('utilisateur_id', Auth::user()->id)->first(['utilisateur_id'])->utilisateur_id)) {
                ConnexionUser::create([
                    'utilisateur_id' => Auth::user()->id,
                    'etat' => 'deconnexion',
                ]);
                $deconnexion = UserEnLigne::where('utilisateur_id', Auth::user()->id)->first();
                $deconnexion->delete('utilisateur_id', Auth::user()->id);
                Session::flush();
                Auth::logout();
                return view('auth.login');
            }
            ConnexionUser::create([
                'utilisateur_id' => Auth::user()->id,
                'etat' => 'deconnexion',
            ]);
            Session::flush();
            Auth::logout();
            return redirect('/');
        }
        return redirect('/');
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

        if (isset(Utilisateur::where('email', $request->email)->first()->id)) {
            $request->validate([
                'email' => 'required',
                'password' => 'required|min:4',
            ]);

            $connection = $request->only('email', 'password');
            $user = Utilisateur::where('email', $request->email)->first();
            if (isset(UserEnLigne::where('utilisateur_id', $user->id)->first(['utilisateur_id'])->utilisateur_id)) {
                return redirect('/')->with('danger', "le compte est déjà en cours d'utilisation");
            } else {
                if (Auth::attempt($connection)) {
                    $users = Utilisateur::where('email', $request->email)->get();

                    if (Auth::check()) {
                        foreach ($users as $user) {
                            if ($user->etat != 0) {
                                ConnexionUser::create([
                                    'utilisateur_id' => $user->id,
                                    'etat' => 'connexion',
                                ]);
                                UserEnLigne::create([
                                    'utilisateur_id' => $user->id,
                                    'etat' => 'en ligne',
                                ]);
                                return redirect()->route('home');
                            }
                            return redirect('/')->with('danger', 'Compte inactif');
                        }
                    }
                    return redirect('/')->with('danger', "Session expirée");
                }
                return redirect('/')->with('danger', 'Login ou mots de passe invalide');
            }
            return redirect('/')->with('danger', "Le compte n'existe pas");
        }
        return redirect('/')->with('danger', "Le compte n'existe pas");
    }

    /**
     * Display the specified resource.
     */
    public function logout()
    {
        if (isset(Auth::user()->id)) {
            $user = Auth::user()->id;

            ConnexionUser::create([
                'utilisateur_id' => $user,
                'etat' => 'deconnexion',
            ]);
            if (isset(UserEnLigne::where('utilisateur_id', Auth::user()->id)->first()->id)) {
                $deconnexion = UserEnLigne::where('utilisateur_id', Auth::user()->id)->first();
                $deconnexion->delete('utilisateur_id', Auth::user()->id);
            }

            Session::flush();
            Auth::logout();
            return redirect('/');
        }
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

    public function user_connexion()
    {
        return view('auth.deconnexion_user_encour');
    }
    public function code()
    {
        return view('auth.code');
    }
    public function validerCode(Request $request)
    {
        $request->validate([
            'code' => 'required|min:7|max:7',
        ]);
            if (isset(UserEnLigne::where('code', $request->code)->first()->id)) {
                $enLigne = UserEnLigne::where('code', $request->code)->first();
                ConnexionUser::create([
                    'utilisateur_id' => $enLigne->utilisateur_id,
                    'code' => $request->code,
                    'etat' => 'deconnexion',
                ]);

                $deconnexion = UserEnLigne::where('code',  $request->code)->first();
                $deconnexion->delete('code',  $request->code);
                Session::flush();
                Auth::logout();
                return redirect('/')->with('success', 'Utilisateur débloqué');
            }else{
                return redirect('/code')->with('danger', 'code incorrect');
            }
    }

    public function restore_connexion(Request $request)
    {
        $adressMail=$request->email;
        $code = mt_rand(1000, 9999);
        $code='AD-'.$code;
        $mailMessage="Utiliser ce code $code pour valider la deconnexion du compte";
        $subject="Code validation";
        $connected = @fsockopen("www.google.com", 80);
        if ($connected){
            $is_conn = true; // Une connexion Internet est disponible
            // fclose($connected);
            if (isset(Utilisateur::where('email', $request->email)->first()->id)) {
                $user = Utilisateur::where('email', $request->email)->first();
                if (isset(UserEnLigne::where('utilisateur_id', $user->id)->first()->id)) {
                   $enLigne = UserEnLigne::where('utilisateur_id', $user->id)->first();
                   $enLigne->update([
                        'utilisateur_id' => $user->id,
                        'code' => $code,
                    ]);
                    Mail::to($adressMail)->send(new AlertCodeReconnexion($mailMessage,$subject));
                    return redirect('/code')->with('success', " Consulter votre boite mail et utiliser le code pour valider ");
                }
                return redirect('/')->with('success', " L'utilisateur n'est pas en cours d'utilisation");
            }

         } else {
            $is_conn = false; // Pas de connexion Internet
            if (isset(Utilisateur::where('email', $request->email)->first()->id)) {
                $user = Utilisateur::where('email', $request->email)->first();
                if (isset(UserEnLigne::where('utilisateur_id', $user->id)->first()->id)) {
                   $enLigne = UserEnLigne::where('utilisateur_id', $user->id)->first();
                   $enLigne->update([
                        'utilisateur_id' => $user->id,
                        'code' => $code,
                    ]);
                    return redirect('/code')->with('success', " Consulter votre boite mail et utiliser le code pour valider ");
                }
                return redirect('/')->with('success', " L'utilisateur n'est pas en cours d'utilisation");
            }
            // return back()->with('danger', " Vous n'avez pas de connexion internet");
        }
        // if (isset(Utilisateur::where('email', $request->email)->first()->id)) {
        //     $user = Utilisateur::where('email', $request->email)->first();
        //     if (isset(UserEnLigne::where('utilisateur_id', $user->id)->first()->id)) {

        //         ConnexionUser::create([
        //             'utilisateur_id' => $user->id,
        //             'etat' => 'deconnexion',
        //         ]);

        //         $deconnexion = UserEnLigne::where('utilisateur_id', $user->id)->first();
        //         $deconnexion->delete('utilisateur_id', $user->id);
        //         Session::flush();
        //         Auth::logout();
        //         return redirect('/')->with('success', 'Utilisateur débloqué');
        //     }
        //     return redirect('/')->with('success', " L'utilisateur n'est pas en cours d'utilisation");
        // }
        // return redirect('/code')->with('danger', " L'utilisateur n'existe pas ");
    }
}

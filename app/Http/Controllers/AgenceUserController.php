<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Utilisateur;
use App\Models\Agence;
use App\Models\Caisse;
use App\Models\CaisseUser;
use App\Models\DeviseAgence;

class AgenceUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){

            $societe_id=Auth::user()->societe_id;
            $role=Auth::user()->role->id;
            $agences=Agence::where('societe_id',$societe_id)->get();

           if($role==1 || $role==0){
            $users=Utilisateur::where('societe_id',$societe_id)->Where('agence_id','!=','0')->get();
            $caisses=Caisse::all();
            return view('agence_user.index',compact('caisses','users','agences'));
           }
            $users=Utilisateur::where('societe_id',$societe_id)->Where('agence_id','!=','0')->where('role_id','!=',1)->Where('role_id','!=',0)->get();
            $caisses=Caisse::all();
            return view('agence_user.index',compact('caisses','users','agences'));            
            
            }
            return redirect('/auth')->with('success',"Session expirée");
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
        /**
             * validation des champs de saisie
             */
            $request->validate([
                'user_id'=>'required',
                'agence_id'=>'required',
            ]);

            /**
             * donnee a ajouté dans la table
             */

            $data=$request->all();

            $utilisateur=Utilisateur::find($data['user_id']);
            /**
             * insertion des données dans la table user
             */
            //dd($utilisateur);
            $utilisateur->update([
                'agence_id'=>$data['agence_id'],
            ]);
            return redirect('/agence_user')->with('success','Agence associé avec succès');
    }

    public function listUser(Request $request)
    {

        if(Auth::check()){
            $societe_id=Auth::user()->societe_id;

            $data['users']=Utilisateur::where('societe_id','=',$societe_id)
            ->where('agence_id','!=',$request->id)
            ->where('agence_id','=',0)
            ->get(['nom','prenom','id']);
            return response()->json($data);
        }
            return redirect('/auth')->with('danger',"Vous n'êtes pas autorisé à accéder");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function asso_agence_annuler(Request $request, $id)
    {

                $user=Utilisateur::find($id);

                $user->update([
                    'agence_id'=>0,
                ]);
                return redirect('/agence_user')->with('success','Association annuler avec succès');
    }


    public function edit_devise(Request $request)
    {
        $devise=DeviseAgence::find($request->id);
            if(isset($devise)){
                $devise->update([
                    'taux'=>$request->taux,
                ]);
                return back()->with('success','taux modifier');
            }
        return back();
    }
}

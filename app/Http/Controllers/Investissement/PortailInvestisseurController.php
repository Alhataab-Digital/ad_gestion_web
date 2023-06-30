<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;
use App\Models\Investisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PortailInvestisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('investissement.portail');
    }

    public function inscrire()
    {
        //
        return view('investissement.inscrire');
    }

    public function profile_investisseur( $id)
    {
        //
        $investisseur=Investisseur::find($id);
        return view('investissement.profile_investisseur',compact('investisseur'));
    }

    public function connect(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $investisseurs=Investisseur::where('email',$request->email)->first();
        $connection=$request->only('email','password');

                if(isset($investisseurs->email)==$connection['email'] && isset($investisseurs->password)==Hash::make($connection['password'])){

                    $investisseurs=Investisseur::where('email',$request->email)->get();
                    foreach($investisseurs as $investisseur){
                        if($investisseur->etat !=0){
                        return redirect('profile/'.$investisseur->id.'/investisseur');
                        }
                        return redirect('/portail')->with('danger','Compte inactif');
                    }
                }
                return redirect('/portail')->with('danger','Login ou mots de passe invalide');




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
        //
        $code=$request->code;

        $request->validate([
            // 'email'=>'required|email|unique:investisseurs',
            'password'=>'required|min:4',
        ]);

        /**
             * donnee a ajouté dans la table
             */
            $data=$request->all();
            if(isset(Investisseur::where('code',$code)->where('password',Null)->first(['id'])->id)){
                $investisseur=Investisseur::where('code',$code)->first();
                /**
                 * insertion des données dans la table user
                 */
                $investisseur->update([
                    'password'=>Hash::make($data['password']),
                ]);

                return redirect('/portail');

            }else{
                return redirect('/inscrire')->with('danger','Vous avez déjà un compte');;
            }


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

    public function recuperation(Request $request){

        if(isset(Investisseur::where('code',$request->code)->first(['id'])->id)){

            $data['inscription']=Investisseur::where('code',$request->code)->get();
            return response()->json($data);

        }

        if(isset(Investisseur::where('code','!=',$request->code)->first(['id'])->id)){

            $data['erreur']=("Vous n'est pas investisseur ");
            return response()->json($data);
        }



    }
}

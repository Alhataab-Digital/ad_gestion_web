<?php

namespace App\Http\Controllers\Api\Investissement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PortailInvestisseur;
use App\Http\Requests\RequestLoginPortailInvestisseur;
use App\Models\Investissement\Investisseur;
use App\Models\Investissement\OperationInvestisseur;
use App\Models\Investissement\OperationDividende;

class PortailInvestisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }

    public function inscrire()
    {
        //

    }

    public function profile_investisseur($id)
    {
        //
        $investisseur = Investisseur::find($id);
        return response(
            [
                'investisseur' =>  $investisseur,
            ],
            200
        );
    }

    public function connect(RequestLoginPortailInvestisseur $request)
    {
        $request->validated();

        $investisseurs = Investisseur::where('email', $request->email)->first();
        if (Investisseur::where('email', $request->email)->count() == 1) {
            if ($investisseurs->email == $request->email && decrypt($investisseurs->password) === $request->password) {
                if ($investisseurs->etat != 0) {
                    $investisseurs = Investisseur::where('email', $request->email)->first();
                    //$token = $investisseurs->createToken('ad_gestion')->plainTextToken;
                    return response(
                        [
                            'investisseur' => $investisseurs,
                            //'token' => $token,
                        ],
                        200
                    );
                }
                return response(
                    [
                        'message' =>  'Compte inactif',
                    ],
                    200

                );
            } else {

                return response(
                    [
                        'message' =>  'Login ou mots de passe invalide',
                    ],
                    200
                );
            }
        }
        return response(
            [
                'message' =>  'Compte introuvable',
            ],
            200
        );
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


        $request->validate([
            // 'email'=>'required|email|unique:investisseurs',
            'password' => 'required|min:4',
            'code' => 'required',
        ]);
        $code = $request->code;
        /**
         * donnee a ajouté dans la table
         */
        $data = $request->all();

        if (isset(Investisseur::where('code', $code)->where('password', Null)->first(['id'])->id)) {

            $investisseur = Investisseur::where('code', $code)->where('password', NULL)->first();
            /**
             * insertion des données dans la table user
             */
            $investisseur->update([
                'password' => encrypt($data['password']),
            ]);

            return response(
                [
                    'message' => "Compte creé avec success",
                ],
                200
            );
        } else {
            return response(
                [
                    'message' => "Vous avez déjà un compte",
                ],
                200
            );
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

    public function recuperation(PortailInvestisseur $request)
    {

        $request->validated();

        if (isset(Investisseur::where('code', $request->code)->where('etat', 1)->first(['id'])->id)) {

            if (isset(Investisseur::where('code', $request->code)->where('etat', 1)->where('password', NULL)->first(['id'])->id)) {

                $data = Investisseur::where('code', $request->code)->where('etat', 1)->where('password', NULL)->first();
                return response(
                    [
                        'investisseur' => $data,
                    ],
                    200
                );
            } else {

                return response(
                    [
                        'message' => "Compte deja créer",
                    ],
                    200
                );
            }
        } else {

            return response(
                [
                    'message' => "Compte non activé ou code incorrect",
                ],
                200
            );
        }
    }

    public function operation_dividende(Request $request)
    {
        //La validation de données
        $this->validate(
            $request,
            [
                'investisseur_id' => 'required',
            ]
        );

        $operations = OperationDividende::where('investisseur_id', $request->investisseur_id)->orderBy('id', 'DESC')->get();

        return response(
            [
                "operations" => $operations
            ],
            200
        );
    }

    public function operation_investisseur(Request $request)
    {
        //La validation de données
        $this->validate(
            $request,
            [
                'investisseur_id' => 'required',
            ]
        );

        $operations = OperationInvestisseur::where('investisseur_id', $request->investisseur_id)->orderBy('id', 'DESC')->get();

        return response(
            [
                "operations" => $operations
            ],
            200
        );
    }
}

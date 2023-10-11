@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>REPARTISSION DIVIDENTE SUR L'ACTIVITE {{ $activite_investissement->type_activite->type_activite }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Accueil</a></li>
          <li class="breadcrumb-item">Gestion investisseur</li>
          <li class="breadcrumb-item active"> investisseur en cours</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
    
        <div class="row">

            <div class="col-lg-12">

                <div class="card recent-sales overflow-auto">


                  <div class="card-body">
                    <h5 class="card-title">
                       <div class="col-sm-12">
                               
                                
                                <p>
                                    @if ($message=Session::get('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    @if ($message=Session::get('danger'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                </p>
                        </div>
                    </h5>
                    <hr>
                    <h5 class="bg-secondary text-white">
                        <table>
                            <tr>
                                {{-- <th>Capital activité</th> --}}
                                {{-- <th>Montant activite</th> --}}
                                <th>Montant total activite</th>
                                <th>Montant total depense</th>
                                <th>Montant total benefice</th>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-control" type="text" name="" id="total_activite" value="{{$activite_investissement->compte_activite}}" required>
                                </td>
                                <td>
                                    <input class="form-control" type="text" onkeyup="prixU()" name="" value="{{$activite_investissement->total_depense}}" id="total_depense"  readonly>
                                </td>
                                <td>
                                    <input class="form-control" type="text" onkeyup="prixU()" name="" id="montant_benefice" value="{{$activite_investissement->compte_activite-$activite_investissement->montant_decaisse}}" readonly>
                                </td>
                                <td>
                                    <input class="form-control" type="hidden" name="montant_activite" id="" value="{{ $activite_investissement->montant_decaisse }}" readonly>
                                </td>
                                <td>
                                    <input class="form-control"  type="hidden" name="" id="" value="{{ $activite_investissement->id }}" readonly>
                                    <input class="form-control" type="hidden" name="" id="" value="{{ $activite_investissement->capital_activite }}" readonly>
                                </td>
                            </tr>
                            <br>
                        </table>
                    </h5>
                    <hr><br>
                    
                    <table class="table table-borderless bg-secondary text-white"  >
                        <thead class=" ">
                            <tr>
                                <th>Secteur de depense</th>
                                <th>Montant depensé</th>
                                <th scope="col">
                                    <!-- <button type="button" class="btn btn-success add_item_btn" ><i class="bi bi-plus-circle"></i> </button> -->
                                </th>
                            </tr>
                        </thead>
                        <tbody class=" text-white" id="show_item" id="tab">
                        <form method="post" action="{{ route('activite_investissement.depense_activite',$activite_investissement->id)}}">
                        @csrf
                            <tr>
                                <th scope="row">
                                    <select class="form-select" name="secteur_id"   onchange="prixU();" >
                                        <option selected disabled value="">Choose...</option>
                                        @foreach ($secteur_depenses as $secteur_depense)
                                        <option value="{{ $secteur_depense->id }}">{{ $secteur_depense->secteur_depense }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th scope="row">
                                    <input class="form-control"  type="text" name="montant_depense"  id="montant_depense" >
                                </th>
                                <td>
                                    <button type="submit" class="btn btn-success " >MAJ</button>
                                </td>
                            </tr>
                        </form>
                           
                        </tbody>
                    </table>
                    <table class="table table-borderless bg-danger text-white"  >
                        <thead class=" ">
                            <tr>
                                <th>Secteur de depense</th>
                                <th>Montant depensé</th>
                                <th scope="col">
                                    <!-- <button type="button" class="btn btn-success add_item_btn" ><i class="bi bi-plus-circle"></i> </button> -->
                                </th>
                            </tr>
                        </thead>
                        <tbody class=" text-white" id="show_item" id="tab">
                            @foreach ($operation_depenses as $operation_depense )
                            <tr>
                                <td scope="row">
                                    <select class="form-select" name="" id=""  readonly>
                                        <option value="">{{ $operation_depense->secteur_depense->secteur_depense }}</option>
                                    </select></td>
                                <td scope="row">
                                <input class="form-control"  value='{{ number_format($operation_depense->montant_depense,2,","," ")." ".$devise->unite}}' readonly>
                                </td>
                                <td>
                                    <a href="{{ route('activite_investissement.supprimer_depense',$operation_depense->id) }}">
                                        <button type="button" class="btn btn-danger" ><i class="bi bi-trash"></i></button>
                                    </a>
                                    
                                </td>
                            </tr>
                            @endforeach
                            @foreach ($livraisons as $livraison )
                            <tr>
                                <td scope="row">
                                    <select class="form-select" name="" id=""  readonly>
                                        <option value="">{{'Livraison N°'.$livraison->id.' du fournisseur '. $livraison->fournisseur->nom_fournisseur }}</option>
                                    </select></td>
                                <td scope="row">
                                <input class="form-control"  value='{{ number_format($livraison->montant_total,2,","," ")." ".$devise->unite}}' readonly>
                                </td>
                                <td>
                                    <!-- <a href="{{ route('activite_investissement.annuler_livraison',$livraison->id) }}"></a> -->
                                        <button type="button" class="btn btn-danger" ><i class="bi bi-trash"></i></button>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table table-borderless bg-success text-white"  >
                        <thead class=" ">
                            <tr>
                                <th>Secteur de reglement facture</th>
                                <th>Montant encaisser</th>
                                <th scope="col">
                                    <!-- <button type="button" class="btn btn-success add_item_btn" ><i class="bi bi-plus-circle"></i> </button> -->
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reglements as $reglement )
                            <tr>
                                <td scope="row">
                                    <select class="form-select" name="" id=""  readonly>
                                        <option value="">{{'Reglement N°'.$reglement->id.' du client '. $reglement->facture->client->nom_client }}</option>
                                    </select></td>
                                <td scope="row">
                                <input class="form-control"  value='{{ number_format($reglement->montant_operation,2,","," ")." ".$devise->unite}}' readonly>
                                </td>
                                <td>
                                    <!-- <a href="{{ route('activite_investissement.annuler_reglement',$reglement->id) }}"></a> -->
                                        <button type="button" class="btn btn-danger" ><i class="bi bi-trash"></i></button>
                                    
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form method="post" action="{{ route('activite_investissement.repartie') }}">
                    @csrf  
                        <table class="table table-borderless datatable">
                                
                                    <input class="form-control" type="hidden" name="compte_activite" id="total_activite" value="{{$activite_investissement->compte_activite}}" required>
                                
                                    <input class="form-control" type="hidden"  name="total_depense" value="{{$activite_investissement->total_depense}}" id="total_depense"  >
                                
                                    <input class="form-control" type="hidden"  name="montant_benefice" id="montant_benefice" value="{{$activite_investissement->compte_activite-$activite_investissement->montant_decaisse}}">
                                
                                    <input class="form-control" type="hidden" name="montant_decaisse" id="" value="{{ $activite_investissement->montant_decaisse }}" >
                                
                                    <input class="form-control"  type="hidden" name="activite_id" id="" value="{{ $activite_investissement->id }}" >
                                    
                                    <input class="form-control" type="hidden" name="capital_activite" id="" value="{{ $activite_investissement->capital_activite }}" >
                                </td>
                                </tr>
                            <thead class="bg-primary text-white">
                            
                                <tr>
                                    <th scope="col">nom investisseur</th>
                                    <th scope="col">Montant investis </th>
                                    <th scope="col">Taux </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail_activite_investissements as $detail_activite_investissement )
                                <tr>
                                    <td scope="row">
                                        <select class="form-select" name="investisseur_id[]" id="">
                                            <option value="{{ $detail_activite_investissement->investisseur->id }}">{{ $detail_activite_investissement->investisseur->nom .' '.$detail_activite_investissement->investisseur->prenom }}</option>
                                        </select></td>
                                        <td scope="row">
                                            <input class="form-control" type="text" name="montant_investis[]" id="" value="{{round( $detail_activite_investissement->montant_investis) }}" readonly>
                                        </td>
                                        <td scope="row">
                                            <input class="form-control" type="text" name="taux[]" id="" value="{{ $detail_activite_investissement->taux/100 }} " readonly>
                                        </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            <br>
                            <button type="submit" class="btn btn-primary">Cloturer l'activité</button>

                            <a href="{{ route('activite_investissement.redemarrer',$activite_investissement->id ) }}">
                                <button type="button" class="btn btn-warning">Redemarrer l'activité</button>
                            </a>
                            <a href="{{ route('activite_investissement.valider') }}">
                                <button type="button" class="btn btn-secondary">Quitter</button>
                            </a>
                    </form>
                                
                </div>

            </div>

        </div><!-- End Recent Sales -->

      </div>
    

    </section>

  </main><!-- End #main -->
  <script src="{{asset('assets/js/jquery.js')}}"></script>
  <!-- <script type="text/javascript">

        // $(document).ready(function(){

        //   $(".add_item_btn").click(function(e){
        //       e.preventDefault();
        //       $("#show_item").prepend(`
        //         <tr>
        //             <th scope="row">
        //                 <select class="form-select" name="secteur_id"  onchange="prixU();"   >
        //                     <option selected disabled value="">Choose...</option>
        //                         @foreach ($secteur_depenses as $secteur_depense)
        //                     <option value="{{ $secteur_depense->id }}">{{ $secteur_depense->secteur_depense }}</option>
        //                         @endforeach
        //                 </select>
        //             </th>
        //             <th scope="row">
        //                 <input class="form-control" onchange="prixU();" type="text" name="montant_depense" id="montant_depense"  >
        //             </th>
        //             <td>
        //                     <button type="button" class="btn btn-danger remove_item_btn" ><i class="bi bi-trash"></i></button>

        //             </td>
        //         </tr>
        //       `);

        //     });
        // });

    //   $(document).on('click','.remove_item_btn', function(e){
    //       e.preventDefault();
    //       let row_item = $(this).parent().parent();
    //       $(row_item).remove();
    //   });


    //       function prixU(){
    //         var montant_activite=document.getElementById('montant_activite');
    //         var montant_benefice=document.getElementById('montant_benefice');
    //         var total_activite=document.getElementById('total_activite');
    //         var montant=document.getElementById('montant_depense').value;

    //               var mt=0;
    //                   var montant_secteur=document.getElementsByName('montant_depense[]');

    //                   for(let index=0;index<montant_secteur.length; index++){
    //                       var montant=montant_secteur[index].value;
    //                       mt=+(mt)+ +(montant);

    //                   }
    //                   document.getElementById('total_depense').value= mt;

    //                   benefice=Number(total_activite.value)-(Number(montant_activite.value)+Number(mt));

    //                   document.getElementById('montant_benefice').value=benefice;


    //           }

  </script> -->
  @endsection

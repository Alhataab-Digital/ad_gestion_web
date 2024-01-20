@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>FERMETURE ACTIVITE VEHICULE </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Accueil</a></li>
          <li class="breadcrumb-item">Activite vehicule</li>
          <li class="breadcrumb-item active">  Fermeture activite</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
    <form method="post" action="{{ route('activite_vehicule.repartie') }}">
        @csrf
        <div class="row">

            <div class="col-lg-12">

                <div class="card recent-sales overflow-auto">


                  <div class="card-body">
                    <h5 class="card-title">
                       <div class="col-sm-12">
                       Activité vehicule N° {{ $activite_vehicule->id .' : '. $activite_vehicule->intitule}}
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
                                <th>Montant total vendu</th>
                                <th>Montant total achat</th>
                                <th>Montant total marge</th>
                            </tr>
                            <tr>
                                <td>
                                <input class="form-control" type="text" name="" id="total_activite" value='{{ number_format($activite_vehicule->montant_vente ,2,","," ")." ".$devise->unite }}' required>
                                <input class="form-control" type="hidden" name="total_activite" id="total_activite" value="{{$activite_vehicule->montant_vente}}" required>
                                </td>
                                <td>
                                <input class="form-control" type="text"  name="" value='{{ number_format($activite_vehicule->total_depense ,2,","," ")." ".$devise->unite }}' id="total_depense"  readonly>
                                <input class="form-control" type="hidden"  name="total_depense" value="{{$activite_vehicule->total_depense}}" id="total_depense"  readonly>
                                </td>
                                <td>
                                <input class="form-control" type="text"  name="" value='{{ number_format($activite_vehicule->montant_benefice ,2,","," ")." ".$devise->unite }}' readonly>
                                <input class="form-control" type="hidden"  name="montant_benefice" value="{{$activite_vehicule->montant_benefice}}" id="montant_benefice"  readonly>
                                </td>
                                <td>
                                <input class="form-control" type="hidden" name="" id="montant_activite" value='{{ number_format($activite_vehicule->montant_decaisse ,2,","," ")." ".$devise->unite }}' readonly>
                                <input class="form-control" type="hidden" name="montant_activite" id="montant_activite" value="{{ $activite_vehicule->montant_decaisse}}" readonly>
                                </td>
                                <td>
                                    <input class="form-control"  type="hidden" name="activite_id" id="" value="{{ $activite_vehicule->id }}" readonly>
                                    <input class="form-control" type="hidden" name="montant" id="" value="{{ $activite_vehicule->capital_activite }}" readonly>
                                </td>
                            </tr>
                            <br>
                        </table>
                    </h5>
                    <table class="table table-borderless bg-danger text-white"  >
                        <thead class=" ">
                            <tr>
                                <th>Achat vehicule</th>
                                <th>Montant </th>
                                <th scope="col">
                                    <!-- <button type="button" class="btn btn-success add_item_btn" ><i class="bi bi-plus-circle"></i> </button> -->
                                </th>
                            </tr>
                        </thead>
                            @foreach ($operation_achats as $operation_achat )
                            <tr>
                                <td scope="row">
                                    <select class="form-select" name="" id=""  readonly>
                                        <option value="">{{'Achat vehicule CH :'.$operation_achat->chassis }}</option>
                                    </select></td>
                                <td scope="row">
                                <input class="form-control"  value='{{ number_format($operation_achat->prix_revient,2,","," ")." ".$devise->unite}}' readonly>
                                </td>
                                <td>
                                        <button type="button" class="btn btn-danger" ><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table table-borderless bg-success text-white"  >
                        <thead class=" ">
                            <tr>
                                <th>Vente vehicule</th>
                                <th>Montant </th>
                                <th scope="col">
                                    <!-- <button type="button" class="btn btn-success add_item_btn" ><i class="bi bi-plus-circle"></i> </button> -->
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($operation_ventes as $operation_vente )
                            <tr>
                                <td scope="row">
                                    <select class="form-select" name="" id=""  readonly>
                                        <option value="">{{'Vente vehicule CH :'.$operation_vente->operation_vehicule_achete->chassis }}</option>
                                    </select></td>
                                <td scope="row">
                                <input class="form-control"  value='{{ number_format($operation_vente->prix_vente,2,","," ")." ".$devise->unite}}' readonly>
                                </td>
                                <td>
                                        <button type="button" class="btn btn-danger" ><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <hr>
                    <table class="table table-borderless datatable">
                      <thead class="bg-primary text-white">
                        <tr>

                          <th scope="col">nom investisseur</th>
                          <th scope="col">Montant investis </th>
                          <th scope="col">Taux </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($detail_activite_vehicules as $detail_activite_vehicule )

                        <tr>
                            <td scope="row">
                                <select class="form-select" name="investisseur_id[]" id="">
                                    <option value="{{ $detail_activite_vehicule->investisseur->id }}">{{ $detail_activite_vehicule->investisseur->nom .' '.$detail_activite_vehicule->investisseur->prenom }}</option>
                                </select></td>
                                <td scope="row">
                                <input class="form-control" type="text" name="" id="" value='{{number_format(round( $detail_activite_vehicule->montant_investis) ,2,","," ")." ".$devise->unite}}'' readonly>
                                <input class="form-control" type="hidden" name="montant_investis[]" id="" value="{{round( $detail_activite_vehicule->montant_investis)}}" readonly>
                                </td>
                                <td scope="row">
                                <input class="form-control" type="text" name="" id="" value="{{ ($detail_activite_vehicule->taux).' %' }}" readonly>
                                <input class="form-control" type="hidden" name="taux[]" id="" value="{{ ($detail_activite_vehicule->taux)/100 }}" readonly>
                                </td>

                        </tr>

                        @endforeach


                      </tbody>
                </table>
                <div class="text-end">
                    @if($activite_vehicule->montant_vente > $activite_vehicule->total_depense)
                    <button type="submit" class="btn btn-danger">Fermer l'activité</button>
                    @endif
                    <a href="{{ route('activite_vehicule') }}">
                        <button type="button" class="btn btn-secondary">Quitter</button>
                     </a>
                </div>
                </div>

            </div>

        </div><!-- End Recent Sales -->

      </div>
    </form>

    </section>

  </main><!-- End #main -->
  <script src="{{asset('assets/js/jquery.js')}}"></script>
  <script type="text/javascript">

      $(document).ready(function(){

          $(".add_item_btn").click(function(e){
              e.preventDefault();
              $("#show_item").prepend(`
                
              `);

            });
        });

      $(document).on('click','.remove_item_btn', function(e){
          e.preventDefault();
          let row_item = $(this).parent().parent();
          $(row_item).remove();
      });


          function prixU(){
            var montant_activite=document.getElementById('montant_activite');
            var montant_benefice=document.getElementById('montant_benefice');
            var total_activite=document.getElementById('total_activite');
            var montant=document.getElementById('montant_depense').value;

                  var mt=0;
                      var montant_secteur=document.getElementsByName('montant_depense[]');

                      for(let index=0;index<montant_secteur.length; index++){
                          var montant=montant_secteur[index].value;
                          mt=+(mt)+ +(montant);

                      }
                      document.getElementById('total_depense').value= mt;

                      benefice=Number(total_activite.value)-(Number(montant_activite.value)+Number(mt));

                      document.getElementById('montant_benefice').value=benefice;


              }

  </script>
  @endsection

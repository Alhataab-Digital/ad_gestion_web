@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>COMMANDE DE PRODUIT ET SERVICE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Documents</li>
          <li class="breadcrumb-item active">Commande</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

                <h5 class="card-title ">
                Commande N° {{ $commande->id .'/'.\Carbon\Carbon::parse($commande->created_at )->format('d/m/Y')}}
                    <div class="text-end">
                        <a  href="{{route('commande')}}">
                            <button class=" btn btn-secondary "><i class="bi bi-box-arrow-right"></i></button>
                        </a>
                    </div>

                </h5>
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
              <form method="post" action="{{ route('livrer.store') }}">
                @csrf
                <!-- Browser Default Validation -->
                  <div >
                  @if($commande->activite_id==NULL) 
                          <div class="col-md-4">
                          <input class="form-control"  type="hidden"  name="fournisseur_id" value="{{ $commande->fournisseur->id  }}" class="form-control">
                           
                          <label for="" class="form-label">Selectionner l'activité</label>
                            <select class="form-select" id="" name="activite" required>
                              <option selected disabled value="">Choose...</option>
                                @foreach ($activite_investissements as $activite )
                                <option value="{{ $activite->id }}">
                                    {{ 'Activite N° '.$activite->id.' : '.$activite->type_activite->type_activite }}
                                </option>
                                @endforeach
                            </select>
                          </div>
                    @else
                    <div class="col-md-4">
                          <input class="form-control"  type="texte"  name="fournisseur_id" value="{{ 'Activite N° '.$commande->activite->id.' : '.$commande->activite->type_activite->type_activite  }}" class="form-control">
                          
                          </div>
                    @endif

                  <div class="bg-secondary text-white " style="text-align: center">
                      <hr>Produits commandé<hr>
                      </div>
                      <!-- Table with stripped rows -->
                      <table class="table table-borderless " >
                          <thead class="bg-primary text-white ">
                              <tr>
                                  <th class="col-lg-5" scope="col">
                                     Produit
                                  </th>
                                  <th class="col-lg-1" scope="col">
                                      Qte
                                  </th>
                                  <th class="col-lg-3" scope="col">
                                      Prix unitaire
                                  </th>
                                  <th class="col-lg-3" scope="col">
                                      Montant total
                                  </th>
                              </tr>
                          </thead>
                          <tbody class=" text-white" id="show_item" id="tab">
                              @foreach ($detail_commandes as $detail_commande )
                              <tr>
                                  <th class="col-lg-5" scope="row">
                                      <select class="form-select" name="produit[]" id="produit"   >
                                          <option data-prix="{{ $detail_commande->produit->prix_unitaire_achat }}" value="{{ $detail_commande->produit->id }}">{{ $detail_commande->produit->nom_produit }}</option>
                                      </select>
                                  </th>
                                  <th class="col-lg-1" scope="row">
                                      <input class="form-control" type="text" name="qte[]" value="{{ $detail_commande->quantite_commandee }}" id="qte_a" readonly>
                                  </th>
                                  <th class="col-lg-3" scope="row" id="prix_u">
                                      <input class="form-control" type="text" name="prix[]" value="{{ $detail_commande->prix_unitaire_commande }}" id="prix_a" readonly>
                                  </th>
                                  <th class="col-lg-3" scope="row">
                                      <input class="form-control"  type="text" name="total[]" value="{{ $detail_commande->quantite_commandee*$detail_commande->prix_unitaire_commande }}" id="total" readonly>
                                  </th>

                              </tr>
                              @endforeach
                          </tbody>
                          <tr>
                            <td></td>
                            <td></td>
                            <th style="text-align: right">
                              Montant HT
                            </th>
                            <td >
                                <input class="form-control"  type="text" name="montant_ht" value="{{ $total_ht->total }}" id="montant_ht">
                            </td>
                            <td></td>
                          </tr>

                      </table>
                      <!-- End Table with stripped rows -->
                      <br>
                      <div class="bg-secondary text-white " style="text-align: center">
                      <hr>Fournisseur<hr>
                      </div>
                        <table  class="table table-borderless ">
                          <tr>
                                <input class="form-control"  type="hidden" name="commande_id" value="{{ $commande->id }}"  >            
                            <th>
                                <label for="inputText" class="col-sm-6 col-form-label">Fournisseur</label>
                                <input class="form-control"  type="text"  value="{{ $commande->fournisseur->nom_fournisseur }}" class="form-control">            
                            </th>
                            <th>
                                <label for="inputText" class="col-sm-6 col-form-label">Telephone</label>
                                <input class="form-control"  type="text"  value="{{ $commande->fournisseur->telephone  }}" class="form-control">            
                            </th>
                            <th>
                                <label for="inputText" class="col-sm-6 col-form-label">Adresse</label>
                                <input class="form-control"  type="text"  value="{{ $commande->fournisseur->adresse  }}" class="form-control">             
                            </th>           
                          </tr>
                        </table>
                      
                      <div >
                        @if ($commande->etat=='en cours')
                        <button  class="btn btn-success"><i class="bi bi-check-square-fill"></i> Confirmer la commande</button>
                        @endif
                       </div>
                  </div>
                <!-- End Browser Default Validation -->
              </form>
              
              <div class="text-end" >
              
                @if ($commande->etat!='annuler')
                <a href="{{ route('livrer.print',encrypt($commande->id)) }}">
                    <button  class="btn btn-info"><i class="bi bi-print"></i> Imprimer</button>
                </a>
                @endif
                @if ($commande->etat=='en cours')
                <a href="{{ route('commande.delete',encrypt($commande->id)) }}">
                    <button  class="btn btn-danger"><i class="bi bi-x-lg"></i> Annuler</button>
                </a>
                @endif
              </div>

            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->
    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script type="text/javascript">



        function prixU(){
                    var ht=0;
                        var totaux=document.getElementsByName('total[]');
                        for(let index=0;index<totaux.length; index++){
                            var total=totaux[index].value;
                            ht=+(ht)+ +(total);
                        }
                        document.getElementById('montant_ht').value= ht;

        }
    </script>

@endsection

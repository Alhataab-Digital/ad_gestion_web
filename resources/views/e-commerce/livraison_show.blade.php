@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>RECEPTION DE PRODUIT ET SERVICE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Documents</li>
          <li class="breadcrumb-item active">livraison</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

                <h5 class="card-title ">
                RECEPTION N° {{ $livraison->id .'/'.\Carbon\Carbon::parse($livraison->created_at )->format('d/m/Y')}}
                    <div class="text-end">
                        <a  href="{{route('livrer')}}">
                            <button class=" btn btn-secondary "><i class="bi bi-box-arrow-right"></i></button>
                        </a>
                    </div>

                </h5>

              <form method="post" action="">
                @csrf
                <!-- Browser Default Validation -->
                <div class="bg-secondary text-white " style="text-align: center">
                    <hr>Entrepot & activité utilisés<hr>
                </div>
                    <table  class="table table-borderless ">
                            <tr>
                                        
                              <th>
                                  <label for="inputText" class="col-sm-2 col-form-label">Entrepot</label>
                                  <div class="">
                                      <input class="form-control"  type="text" name="montant_decaisser" value="{{ $livraison->entrepot->nom_entrepot  }}" class="form-control">
                                  </div>
                              </th>
                              <th>
                                  <label for="inputText" class="col-sm-2 col-form-label">Activite</label>
                                  <div class="">
                                      <input class="form-control"  type="text" name="montant_decaisser" value="{{ 'Activite N°  '. $livraison->commande->activite->id.' : '.$livraison->commande->activite->type_activite->type_activite  }}" class="form-control">
                                  </div>
                              </th>          
                            </tr>
                      </table>
                  <div class="col mb-3">
                    
                    </div>
                    <div class="bg-secondary text-white " style="text-align: center">
                    <hr>Produit receptionné<hr>
                </div>
                  <div >
                    
                      <!-- Table with stripped rows -->
                      <table class="table table-borderless " >
                          <thead class="bg-primary text-white ">
                              <tr>
                                  <th scope="col">
                                     Produit
                                  </th>
                                  <th scope="col">
                                      Qte
                                  </th>
                                  <th scope="col">
                                      Prix unitaire
                                  </th>
                                  <th scope="col">
                                      Montant total
                                  </th>
                              </tr>
                          </thead>

                        @foreach ($detail_livraisons as $detail_livraison )
                        <tbody class=" text-white" id="show_item" id="tab">
                            <tr>
                                <th scope="row">
                                    <select class="form-select" name="produit_id[]" id="produit"   >
                                        <option  value="{{ $detail_livraison->produit->id }}">{{ $detail_livraison->produit->nom_produit }}</option>
                                    </select>
                                </th>
                                <th scope="row">
                                    <input class="form-control" type="text" name="qte[]" value="{{ $detail_livraison->quantite_livree }}" id="qte_a" readonly>
                                </th>
                                <th scope="row" id="prix_u">
                                    <input class="form-control" type="text" name="prix[]" value="{{ $detail_livraison->prix_unitaire_livre }}" id="prix_a" readonly>
                                </th>
                                <th scope="row">
                                    <input class="form-control"  type="text" name="total[]" value="{{ $detail_livraison->quantite_livree*$detail_livraison->prix_unitaire_livre }}" id="total" readonly>
                                </th>

                            </tr>

                        </tbody>
                        @endforeach
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
                      <div class="bg-secondary text-white " style="text-align: center">
                          <hr>Info Fournisseur<hr>
                      </div>
                      <table  class="table table-borderless ">
                            <tr>
                                        
                              <th>
                                  <label for="inputText" class="col-sm-6 col-form-label">Client</label>
                                  <input class="form-control"  type="text"  value="{{ $livraison->fournisseur->nom_fournisseur}}" class="form-control">            
                              </th>
                              <th>
                                  <label for="inputText" class="col-sm-6 col-form-label">Telephone</label>
                                  <input class="form-control"  type="text"  value="{{ $livraison->fournisseur->telephone  }}" class="form-control">            
                              </th>
                              <th>
                                  <label for="inputText" class="col-sm-6 col-form-label">Adresse</label>
                                  <input class="form-control"  type="text"  value="{{ $livraison->fournisseur->adresse  }}" class="form-control">             
                              </th>           
                            </tr>
                          </table>
                  </div>
                <!-- End Browser Default Validation -->

              </form>
              <hr>
              <div class="text-end" >

                <a href="{{ route('livrer.print',$livraison->id) }}">
                    <button  class="btn btn-info"><i class="bi bi-print"></i> Imprimer</button>
                </a>
                {{-- <a href="{{ route('livrer.delete',$livraison->id) }}">
                    <button  class="btn btn-danger"><i class="bi bi-x-lg"></i> Annuler</button>
                </a> --}}
              <hr>
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

@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>FACTURE DE PRODUIT ET SERVICE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Documents</li>
          <li class="breadcrumb-item active">facture</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

                <h5 class="card-title ">
                Facture N° {{ $facture->id .'/'.\Carbon\Carbon::parse($facture->created_at )->format('d/m/Y')}}
                    <div class="text-end">
                        <a  href="{{route('devis')}}">
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
                <!-- Browser Default Validation -->
                <div >    
                <form method="post" action="{{ route('detail_facture.store') }}">
                  @csrf
                  <div class="col-md-4">
                    <input class="form-control"  type="hidden" name="facture_id" value="{{ $facture->id }}"  >
                    <input class="form-control"  type="hidden" id ="devis_id" name="devis_id" value="{{ $devis->id }}"  >
                    <input class="form-control"  type="hidden" name="client" value="{{ $devis->client_id }}"  >
                    
                    

                  </div>
                  <table  class="table table-borderless ">
                            <tr>
                                        
                              <th>
                                <label for="" class="form-label">Entrepot</label>
                                  @if($facture->entrepot_id==NULL)
                                    <select class="form-select" id="entrepot" name="entrepot" required>
                                      <option selected disabled value="">Choose...</option>
                                        @foreach ($entrepots as $entrepot )
                                        <option value="{{ $entrepot->id }}">
                                            {{ $entrepot->nom_entrepot }}
                                        </option>
                                        @endforeach
                                    </select>
                                  @else
                                    <select class="form-select" id="entrepot" name="entrepot" required>
                                        <option value="{{ $facture->entrepot_id }}">
                                          {{ $facture->entrepot_stock->nom_entrepot }}
                                        </option>
                                        @foreach ($entrepots as $entrepot )
                                        <option value="{{ $entrepot->id }}">
                                            {{ $entrepot->nom_entrepot }}
                                        </option>
                                        @endforeach
                                        
                                    </select>
                                  @endif
                              </th>
                              <th>
                                  <label for="inputText" class="col-sm-2 col-form-label">Activite</label>
                                  <div class="">
                                      <input class="form-control"  type="text" name="" value="{{ 'Activite N°  '. $facture->devis->activite_id.' : '.$facture->devis->activite->type_activite->type_activite  }}" class="form-control">
                                  </div>
                              </th>          
                            </tr>
                      </table>
                  <br>
                  <hr>
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
                                  @if($facture->etat==NULL) 
                                  <th scope="col">
                                      Action
                                  </th>
                                  @endif
                              </tr>
                          </thead>
                          @if($facture->etat==NULL) 
                          <tbody class=" text-white" id="show_item" id="tab">
                            <tr>
                                <th scope="row">
                                    <select class="form-select" name="produit_id" id="produit" required  >
                                            <option selected disabled value="">Choose...</option>
                                        @foreach ($detail_deviss as $detail_devis )
                                            <option value="{{ $detail_devis->produit->id }}">{{ $detail_devis->produit->nom_produit }}</option>
                                      @endforeach
                                    </select>
                                </th>
                                <th scope="row" id="qte">
                                    <input class="form-control" type="text" >
                                </th>
                                <th scope="row" id="prix_u">
                                    <input class="form-control"  type="text"  >
                                </th>
                                <th scope="row" id="total_p">
                                  <input class="form-control" id="total" type="text" name="total" onkeyup="prixU();" >
                                </th>
                                <td>
                                    <button type="submit" class="btn btn-success remove_item_btn" ><i class="bi bi-save"></i></button>
                                </td>
                            </tr>
                          </tbody>
                          @endif
                          </table>
                    </form>
                          
                      @foreach($detail_factures as $detail_facture)
                      <table class="table table-borderless " >
                      <tbody>
                      <tr >
                                  <th scope="row">
                                      <select class="form-select"    >
                                          <option  value="{{ $detail_facture->produit->id }}">{{ $detail_facture->produit->nom_produit }}</option>
                                      </select>
                                  </th>
                                  <th scope="row" id="">
                                      <input class="form-control"   type="text" value="{{$detail_facture->quantite_vendue}}" >
                                  </th>
                                  <th scope="row" id="">
                                      <input class="form-control"   type="text" value="{{$detail_facture->prix_unitaire_vendu}}"  >
                                  </th>
                                  <th scope="row" id="">
                                      <input class="form-control"   type="text" name="total"  value="{{$detail_facture->quantite_vendue*$detail_facture->prix_unitaire_vendu}}" >
                                  </th>
                                  
                                @if($facture->etat==NULL) 
                                  <td>
                                    <a href="{{route('detail_facture.delete',encrypt($detail_facture->id))}}">
                                    <button class="btn btn-danger remove_item_btn" ><i class="bi bi-trash"></i></button>
                                    </a>
                                  </td>
                                @endif
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
                        </tr>

                    </table>
                    <div class="bg-secondary text-white " style="text-align: center">
                          <hr>Info client<hr>
                          </div>
                          
                          <table  class="table table-borderless ">
                            <tr>
                                  <input class="form-control"  type="hidden" name="devis_id" value="{{ $devis->id }}"  >   
                                           
                              <th>
                                  <label for="inputText" class="col-sm-6 col-form-label">Client</label>
                                  <input class="form-control"  type="text"  value="{{ $devis->client->nom_client }}" class="form-control">            
                              </th>
                              <th>
                                  <label for="inputText" class="col-sm-6 col-form-label">Telephone</label>
                                  <input class="form-control"  type="text"  value="{{ $devis->client->telephone  }}" class="form-control">            
                              </th>
                              <th>
                                  <label for="inputText" class="col-sm-6 col-form-label">Adresse</label>
                                  <input class="form-control"  type="text"  value="{{ $devis->client->adresse  }}" class="form-control">             
                              </th>           
                            </tr>
                          </table>
                      <div >
                        <hr>
                    <!-- End Table with stripped rows -->
                    <div class="text-end" >
                    @if($facture->etat==NULL) 
                    <form class="row g-3" method="post" action="{{ route('facture.update',encrypt($facture->id)) }}">
                      @csrf
                      <input class="form-control"  type="hidden" name="client_id" value="{{ $devis->client->id }}" class="form-control">            
                      <input class="form-control" type="hidden" name="montant_ht" value="{{$total_ht->total}}">
                      <div class="text-left">
                            <button type="submit" class="btn btn-success"><i class="bx bxs-save" ></i> Sauvegarde</button>
                      </div>
                    </div>
                  </form>
                  @endif
                </div>
              <!-- End Browser Default Validation -->

            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->
  <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script type="text/javascript">

       $('#produit').change(function(event){

                var produit_id=this.value;
                var devis_id=document.getElementById('devis_id').value;
                // alert(devis_id);
                $('#qte').html('');
                $('#prix_u').html('');
                $.ajax({
                    url:"{{ route('produit_select.facture') }}",
                    type:'post',
                    dataType:'json',
                    data: {id:produit_id,devis_id:devis_id , _token:"{{ csrf_token() }}"},

                    success:function(response){
                    $.each(response.produits,function(edit,val){

                      $("#qte").append('<input class="form-control" onchange="prixU();" id="qte_v" type="text" name="qte" value="'+val.quantite_demandee+'" >');

                      $("#prix_u").append('<input class="form-control" onchange="prixU();" id="prix_v" type="text" name="prix" value="'+val.prix_unitaire_demande+'" >');
                      
                    })
                  }
                })

            });

          $('#entrepot').change(function(event)
            {

              var entrepot=this.value;
              var devis_id=document.getElementById('devis_id').value;
              // alert(devis_id);
              // alert(entrepot,devis_id);
              // $('#entrepot').html('');
              $.ajax({
                  url:"{{ route('detail_facture_entrepot.select') }}",
                  type:'post',
                  dataType:'json',
                  data: {id:entrepot ,devis_id:devis_id , _token:"{{ csrf_token() }}"},

                  success:function(response){
                  $.each(response.entrepot,function(edit,val){
                    // $("#entrepot").append('<label for="" class="form-label">Entrepot</label><select class="form-select" id="" name="entrepot" required><option value="'+val.id+'">"'+val.nom_entrepot+'"</option></select>');

                  })
                  }
              })

            });

        function prixU(){
                    var produit=document.getElementById('produit');
                    var quantite=document.getElementById('qte_v');
                    // var total=document.getElementById('total');
                    var prix=document.getElementById('prix_v');
                    // var prix_unitaire = produit.options[produit.selectedIndex].getAttribute('data-prix');
                    // prix_a.value=prix_unitaire;

                    total= Number(quantite.value)*Number(prix.value);
                    document.getElementById('total').value= total;

                    // alert(total);
                    var ht=0;
                        var totaux=document.getElementsByName('total');
                        for(let index=0;index<totaux.length;index++){
                            var total=totaux[index].value;
                            ht=+(ht)+ +(total);
                        }
                        document.getElementById('montant_ht').value= ht;
        }

    </script>

@endsection

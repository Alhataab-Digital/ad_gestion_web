@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>DEVIS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Documents</li>
          <li class="breadcrumb-item active">devis</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                 Devis N° {{ $devis->id .'/'.\Carbon\Carbon::parse($devis->created_at )->format('d/m/Y')}}
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
                <div class="bg-secondary text-white " style="text-align: center">
                  <hr>Devis produits<hr>
                </div>
              <!-- Table with stripped rows -->
              <table class="table table-borderless " >
                          <thead class="bg-primary text-white ">
                              <tr>
                                  <th class="col-lg-4" scope="col">
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
                                  <th class="col-lg-1" scope="col">
                                    Action
                                    <!-- <button type="button" class="btn btn-success add_item_btn" ><i class="bi bi-plus-circle"></i> </button> -->
                                  </th>
                              </tr>
                          </thead>
                  </table>
                          <form class="row g-3" method="post" action="{{ route('detail_devis.store') }}">
                            @csrf
                            <table class="table table-borderless " >
                              <tbody class=" text-white" >
                                  <tr class="" >
                                      <th class="col-lg-4" scope="row">
                                      <input class="form-control"  type="hidden" name="devis_id" value="{{ $devis->id }}"  >
        
                                          <select class="form-select" name="produit" id="produit" required  >
                                              <option selected disabled value="">Choose...</option>
                                              @foreach ($produits as $produit)
                                              <option  value="{{ $produit->id }}">{{ $produit->nom_produit }}</option>
                                              @endforeach
                                          </select>
                                      </th>
                                      <th class="col-lg-1" scope="row" id="qte">
                                          <input class="form-control" type="text" >
                                      </th>
                                      <th class="col-lg-3" scope="row" id="prix_u">
                                          <input class="form-control"  type="text"  >
                                      </th>
                                      <th class="col-lg-3" scope="row" id="total_p">
                                    <input class="form-control" id="total" type="text" name="total" onkeyup="prixU();" >

                                      </th>
                                      <td class="col-lg-1">
                                        <button type="submit" class="btn btn-success remove_item_btn" ><i class="bi bi-save"></i></button>
                                      </td>
                                  </tr>
                              </tbody>
                            </table>
                          </form>
                          <table class="table table-borderless " >
                              
                              @foreach($detail_deviss as $detail_devis)
                                  <tr >
                                      <th class="col-lg-4" scope="row">
                                          <select class="form-select"  id="produit" required  >
                                              <option  value="{{ $detail_devis->produit->id }}">{{ $detail_devis->produit->nom_produit }}</option>
                                          </select>
                                      </th>
                                      <th class="col-lg-1" scope="row" id="">
                                          <input class="form-control"   type="text" value="{{$detail_devis->quantite_demandee}}" >
                                      </th>
                                      <th class="col-lg-3" scope="row" id="">
                                          <input class="form-control"   type="text" value="{{$detail_devis->prix_unitaire_demande}}"  >
                                      </th>
                                      <th class="col-lg-3" scope="row" id="">
                                          <input class="form-control"   type="text" name="total"  value="{{$detail_devis->quantite_demandee*$detail_devis->prix_unitaire_demande}}" >
                                      </th>
                                      <td class="col-lg-1" >
                                        <a href="{{route('detail_devis.delete',$detail_devis->id)}}">
                                        <button class="btn btn-danger remove_item_btn" ><i class="bi bi-trash"></i></button>
                                        </a>
                                      </td>
                                  </tr>
                              @endforeach
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <th style="text-align: right">
                                    Montant HT
                                  </th>
                                  <td >
                                      <input class="form-control"  onkeyup="prixU()"  type="text" name="montant_ht" id="montant_ht" value="{{$total_ht->total}}">
                                  </td>
                                  <td></td>
                                </tr>
                          </table>
                          <!-- End Table with stripped rows -->
                          <div class="bg-secondary text-white " style="text-align: center">
                          <hr>Info client<hr>
                          </div>
                          <div class="col-md-0">
                              <form class="row g-3" method="post" action="{{ route('devis.store') }}">
                                  @csrf
                                      <input class="form-control" type="hidden" name="montant_ht" value="{{$total_ht->total}}">
                                      <input class="form-control"  type="hidden" name="devis_id" value="{{ $devis->id }}"  >
                                  <div class="col-md-4">
                                    <label for="validationDefault01" class="form-label">Telephone</label>
                                    <input type="text" class="form-control" name="telephone" id="telephone"  required>
                                  </div>
                                  <div class="col-md-4" id="nom">
                                  </div>
                                  <div class="col-md-4" id="adresse">
                                  </div>
                                  <div class="col-md-0" id="id">
                                  </div>
                                  <hr>
                                  <div class="col-12 text-left">
                                      <button type="submit" class="btn btn-success"><i class="bx bxs-save" ></i> Sauvegarde</button>
                                  </div>
                              </form>
                          </div>
                        <div class="text-end" >
              
                        @if ($devis->etat!='annuler')
                        <!-- <a href="{{ route('devis.print',$devis->id) }}">
                            <button  class="btn btn-info"><i class="bi bi-print"></i> Imprimer</button>
                        </a> -->
                        <a href="{{ route('devis.delete',$devis->id) }}">
                            <button  class="btn btn-danger"><i class="bi bi-x-lg"></i> Annuler</button>
                        </a>
                        @endif
                        <hr>
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

                $('#qte').html('');
                $('#prix_u').html('');
                $.ajax({
                    url:"{{ route('produit_select.devis') }}",
                    type:'post',
                    dataType:'json',
                    data: {id:produit_id , _token:"{{ csrf_token() }}"},

                    success:function(response){
                    $.each(response.produits,function(edit,val){

                      $("#qte").append('<input class="form-control" onchange="prixU();" id="qte_v" type="text" name="qte" value="1" >');

                      $("#prix_u").append('<input class="form-control" onchange="prixU();" id="prix_v" type="text" name="prix" value="'+val.prix_unitaire_vente+'" >');
                      
                    })
                  }
                })

            });

            $('#telephone').change(function(event)
            {

              var telephone=this.value;

              $('#nom').html('');
              $('#adresse').html('');
              $.ajax({
                  url:"{{ route('detail_devis_client.select') }}",
                  type:'post',
                  dataType:'json',
                  data: {id:telephone , _token:"{{ csrf_token() }}"},

                  success:function(response){
                  $.each(response.client,function(edit,val){

                    $("#nom").append('<label for="validationDefault02" class="form-label">nom client</label><input class="form-control"  type="text" name="nom_client" value="'+val.nom_client+'" required >');

                    $("#adresse").append('<label for="validationDefault02" class="form-label">Adresse</label><input class="form-control"type="text" name="adresse" value="'+val.adresse+'" required >');
                    
                    $("#id").append('<input class="form-control" type="hidden" name="client_id" value="'+val.id+'" required >');

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

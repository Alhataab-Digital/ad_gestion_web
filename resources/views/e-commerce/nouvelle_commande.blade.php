@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Commande</h1>
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
              <h5 class="card-title">Commande N° {{ $commande->id }}</h5>
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
              
              <form class="row g-3" method="post"  action="{{ route('commande.store') }}">
                @csrf
                <div class="text-left">
                          <button type="submit" class="btn btn-success"><i class="bx bxs-save" ></i> </button>
                </div>
                <input class="form-control" type="hidden" name="montant_ht" value="{{$total_ht->total}}">
                <input class="form-control"  type="hidden" name="commande_id" value="{{ $commande->id }}"  >
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
                <!-- <div class="col-12">
                  <button class="btn btn-primary" type="submit">Submit form</button>
                </div> -->
              </form>
              <br>
              <hr>
              <br>
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
                                  <th scope="col">
                                    Action
                                    <!-- <button type="button" class="btn btn-success add_item_btn" ><i class="bi bi-plus-circle"></i> </button> -->
                                  </th>
                              </tr>
                          </thead>
                          </table>
                          <form class="row g-3" method="post" action="{{ route('detail_commande.store') }}">
                            @csrf
                          <table class="table table-borderless " >
                          <tbody class=" text-white" >
                              <tr class="" >
                                  <th scope="row">
                                  <input class="form-control"  type="hidden" name="commande_id" value="{{ $commande->id }}"  >
    
                                      <select class="form-select" name="produit" id="produit"   >
                                          <option selected disabled value="">Choose...</option>
                                          @foreach ($produits as $produit)
                                          <option  value="{{ $produit->id }}">{{ $produit->nom_produit }}</option>
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
                          </table>
                          </form>
                          <table class="table table-borderless " >
                          
                          @foreach($detail_commandes as $detail_commande)
                              <tr >
                                  <th scope="row">
                                      <select class="form-select"  id="produit" required  >
                                          <option  value="{{ $detail_commande->produit->id }}">{{ $detail_commande->produit->nom_produit }}</option>
                                      </select>
                                  </th>
                                  <th scope="row" id="">
                                      <input class="form-control"   type="text" value="{{$detail_commande->quantite_commandee}}" >
                                  </th>
                                  <th scope="row" id="">
                                      <input class="form-control"   type="text" value="{{$detail_commande->prix_unitaire_commande}}"  >
                                  </th>
                                  <th scope="row" id="">
                                      <input class="form-control"   type="text" name="total"  value="{{$detail_commande->quantite_commandee*$detail_commande->prix_unitaire_commande}}" >
                                  </th>
                                  <td>
                                    <a href="{{route('detail_commande.delete',$detail_commande->id)}}">
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
                      <br>
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

                $('#qte').html('');
                $('#prix_u').html('');
                $.ajax({
                    url:"{{ route('produit_select.commande') }}",
                    type:'post',
                    dataType:'json',
                    data: {id:produit_id , _token:"{{ csrf_token() }}"},

                    success:function(response){
                    $.each(response.produits,function(edit,val){

                      $("#qte").append('<input class="form-control" onchange="prixU();" id="qte_a" type="text" name="qte" value="1" >');

                      $("#prix_u").append('<input class="form-control" onchange="prixU();" id="prix_a" type="text" name="prix" value="'+val.prix_unitaire_achat+'" >');
                      
                    })
                  }
                })

            });

            $('#telephone').change(function(event)
            {

              var telephone=this.value;
// alert(telephone);
              $('#nom').html('');
              $('#adresse').html('');
              $.ajax({
                  url:"{{ route('detail_commande_fournisseur.select') }}",
                  type:'post',
                  dataType:'json',
                  data: {id:telephone , _token:"{{ csrf_token() }}"},

                  success:function(response){
                  $.each(response.fournisseur,function(edit,val){

                    $("#nom").append('<label for="validationDefault02" class="form-label">nom fournisseur</label><input class="form-control"  type="text" name="nom_fournisseur" value="'+val.nom_fournisseur+'" >');

                    $("#adresse").append('<label for="validationDefault02" class="form-label">Adresse</label><input class="form-control"type="text" name="adresse" value="'+val.adresse+'" >');
                    
                    $("#id").append('<input class="form-control" type="hidden" name="fournisseur_id" value="'+val.id+'" >');

                  })
                  }
              })

            });

        function prixU(){
                    var produit=document.getElementById('produit');
                    var quantite=document.getElementById('qte_a');
                    // var total=document.getElementById('total');
                    var prix=document.getElementById('prix_a');
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

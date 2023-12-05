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
              <h5 class="card-title">Commande N° </h5>
              {{-- <p>Browser default validation with using the <code>required</code> keyword. Try submitting the form below. Depending on your browser and OS, you’ll see a slightly different style of feedback.</p> --}}
              <form class="row g-3" method="post" action="{{ route('detail_commande.store') }}">
                @csrf
                <!-- Browser Default Validation -->

                  <div class="col-md-3">
                    <input class="form-control"  type="hidden" name="commande_id" value="{{ $commande->id }}"  >
                    <label for="" class="form-label">Fournisseur</label>
                    <select class="form-select" id="" name="fournisseur" required>
                      <option value="{{ $commande->fournisseur->id }}">{{ $commande->fournisseur->nom_fournisseur }}</option>
                    </select>
                  </div>
                  <div class="col mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Telephone</label>
                    <div class="col-sm-3">
                        <input class="form-control"  type="text" name="montant_decaisser" value="{{ $commande->fournisseur->telephone  }}" class="form-control">
                    </div>
                    </div>
                  <br>
                  <hr>
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
                                  <th scope="col">
                                    <button type="button" class="btn btn-success add_item_btn" ><i class="bi bi-plus-circle"></i> </button>
                                  </th>
                              </tr>
                          </thead>
                          <tbody class=" text-white" id="show_item" id="tab">
                            @foreach ($detail_commandes as $detail_commande )
                              <tr>
                                <th scope="row">
                                    <select class="form-select" name="produit[]" id="produit"   >
                                        <option data-prix="{{ $detail_commande->produit->prix_unitaire_achat }}" value="{{ $detail_commande->produit->id }}">{{ $detail_commande->produit->nom_produit }}</option>
                                    </select>
                                </th>
                                <th scope="row">
                                    <input class="form-control" type="text" name="qte[]" value="{{ $detail_commande->quantite_commandee }}" id="qte_a" readonly>
                                </th>
                                <th scope="row" id="prix_u">
                                    <input class="form-control" type="text" name="prix[]" value="{{ $detail_commande->prix_unitaire_commande }}" id="prix_a" readonly>
                                </th>
                                <th scope="row">
                                    <input class="form-control"  type="text" name="total[]" value="{{ $detail_commande->quantite_commandee*$detail_commande->prix_unitaire_commande }}" id="total" readonly>
                                </th>
                                <td>
                                    <button type="button" class="btn btn-danger remove_item_btn" ><i class="bi bi-trash"></i></button>
                                </td>
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
                                <input class="form-control"  onkeyup="prixU()"  type="text" name="montant_ht" id="montant_ht">
                            </td>
                            <td></td>
                          </tr>

                      </table>
                      <!-- End Table with stripped rows -->
                      <br>
                      <div class="text-left">
                          <button type="submit" class="btn btn-success"><i class="bx bxs-save" ></i> </button>
                      </div>
                  </div>
                <!-- End Browser Default Validation -->

              </form>


            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->
    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function(){

            $(".add_item_btn").click(function(e){
                e.preventDefault();
                $("#show_item").prepend(`
                <tr >
                    <th scope="row">
                        <select class="form-select" name="produit[]" id="produit" required onchange="prixU()" >
                            <option selected disabled value="">Choose...</option>
                               @foreach ($produits as $produit)
                            <option data-prix="{{ $produit->prix_unitaire_achat }}" value="{{ $produit->id }}">{{ $produit->nom_produit }}</option>
                                @endforeach
                        </select>
                    </th>
                    <th scope="row">
                        <input class="form-control" onchange="prixU()"  type="text" value="1" name="qte[]" id="qte_a">
                    </th>
                    <th scope="row" id="prix">
                        <input class="form-control" onkeyup="prixU();" type="text" name="prix[]" id="prix_a" >
                    </th>
                    <th scope="row">
                        <input class="form-control" onkeyup="prixU();" type="text" name="total[]" id="total">
                    </th>
                    <td>
                            <button type="button" class="btn btn-danger remove_item_btn" ><i class="bi bi-trash"></i></button>

                    </td>
                </tr>

                `);

                // $('#produit').change(function(event){

                //     var produit_id=this.value;

                //     $('#prix').html('');
                //     $.ajax({
                //         url:"{{ route('produit.select') }}",
                //         type:'post',
                //         dataType:'json',
                //         data: {id:produit_id , _token:"{{ csrf_token() }}"},

                //         success:function(response){

                //         $.each(response.produits,function(edit,val){

                //             $("#prix").append('<input class="form-control" id="prix_v" type="text" name="prix[]" value="'+val.prix_unitaire_achat+'" >');

                //         })
                //         }
                //     })

                // });
            });

            // $('#produit').change(function(event){

            //     var produit_id=this.value;

            //     $('#prix_u').html('');
            //     $.ajax({
            //         url:"{{ route('produit.select') }}",
            //         type:'post',
            //         dataType:'json',
            //         data: {id:produit_id , _token:"{{ csrf_token() }}"},

            //         success:function(response){
            //         $.each(response.produits,function(edit,val){

            //             $("#prix_u").append('<input class="form-control" id="prix_v" type="text" name="prix[]" value="'+val.prix_unitaire_achat+'" >');

            //         })
            //         }
            //     })

            // });

        });

        $(document).on('click','.remove_item_btn', function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });


            function prixU(){
                    var produit=document.getElementById('produit');
                    var quantite=document.getElementById('qte_a');
                    var total=document.getElementById('total');
                    var prix_a=document.getElementById('prix_a');
                    var prix_unitaire = produit.options[produit.selectedIndex].getAttribute('data-prix');
                    prix_a.value=prix_unitaire;


                    total.value=Number(quantite.value)*Number(prix_a.value);

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

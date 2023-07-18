<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\UserController;

use App\Http\Controllers\SocieteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\AgenceUserController;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\CaisseUserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\AutresOperationController;
use App\Http\Controllers\CategorieProduitController;
use App\Http\Controllers\ProduitController;


use App\Http\Controllers\Cash\TrancheTarifController;
use App\Http\Controllers\Cash\DeviseController;
use App\Http\Controllers\Cash\AchatDeviseController;
use App\Http\Controllers\Cash\VenteDeviseController;
use App\Http\Controllers\Cash\EnvoiController;
use App\Http\Controllers\Cash\RetraitController;



use App\Http\Controllers\Investissement\InvestisseurController;
use App\Http\Controllers\Investissement\VersementInvestisseurController;
use App\Http\Controllers\Investissement\RetraitInvestisseurController;
use App\Http\Controllers\Investissement\RetraitDividendeController;
use App\Http\Controllers\Investissement\ActiviteInvestissementController;
use App\Http\Controllers\Investissement\DetailActiviteInvestissementController;
use App\Http\Controllers\Investissement\TypeActiviteInvestissementController;
use App\Http\Controllers\Investissement\NatureOperationChargeController;
use App\Http\Controllers\Investissement\SecteurDepenseController;
use App\Http\Controllers\Investissement\PortailInvestisseurController;
use App\Http\Controllers\Investissement\AchatVoitureController;
use App\Http\Controllers\Investissement\VenteVoitureController;



use App\Http\Controllers\Hotel\TypeChambreController;
use App\Http\Controllers\Hotel\TypeServiceController;



use App\Http\Controllers\Stock\EntrepotController;
use App\Http\Controllers\Stock\InventaireStockController;


use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DetailCommandeController;
use App\Http\Controllers\LivrerController;
use App\Http\Controllers\DetailLivrerController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\DetailDevisController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\DetailFactureController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(LoginController::class)->group(function(){
    Route::get('/','login')->name('login');
    Route::post('/auth','store')->name('login.store');
    Route::get('/logout','logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function(){

    Route::get('/registre','index')->name('registre');
    Route::post('/registre','store')->name('registre.store');

});

Route::middleware('auth')->controller(HomeController::class)->group(function(){
    Route::get('/home','index')->name('home');
    Route::get('/{id}/activer','store')->name('activer.environnement');
});

Route::middleware('auth')->controller(UserController::class)->group(function(){
    Route::get('/users/index','index')->name('users.index');
    Route::post('/users/store','store')->name('users.store');
    Route::get('/users/{id}/edit','edit')->name('users.edit');
    Route::post('/users/{id}/update','update')->name('users.update');
    Route::get('/users/{id}/active','active')->name('users.active');
    Route::get('/users/{id}/inactive','inactive')->name('users.inactive');
    Route::post('/users/{id}/role','role')->name('users.role');
    Route::post('/users/{id}/password','password')->name('users.password');
    Route::post('/users/permission','permission')->name('users.permission');
});

Route::middleware('auth')->controller(SocieteController::class)->group(function(){
    Route::get('/societe','index')->name('workspace');
    Route::post('/societe/creation','store')->name('workspace.store');
    Route::get('/societe/{id}/detail','show')->name('workspace.show');
    Route::get('/societe/{id}/edit','edit')->name('workspace.edit');
    Route::post('/societe/{id}/update','update')->name('workspace.update');
});

Route::middleware('auth')->controller(ProfileController::class)->group(function(){
    Route::get('/profile','index')->name('profile');
});

Route::middleware('auth')->controller(RoleController::class)->group(function(){
    Route::get('/role','index')->name('role');
    Route::post('/role/creation','store')->name('role.store');
    Route::get('/role/{id}/detail','show')->name('role.show');
    Route::get('/role/{id}/edit','edit')->name('role.edit');
    Route::post('/role/{id}/update','update')->name('role.update');
});

Route::middleware('auth')->controller(AgenceController::class)->group(function(){
    Route::get('/agence','index')->name('agence');
    Route::post('/agence/creation','store')->name('agence.store');
    Route::get('/agence/{id}/detail','show')->name('agence.show');
    Route::get('/agence/{id}/edit','edit')->name('agence.edit');
    Route::post('/agence/{id}/update','update')->name('agence.update');
    Route::post('/agence/devise','devise')->name('agence.devise');
});

Route::middleware('auth')->controller(CaisseController::class)->group(function(){
    Route::get('/caisse','index')->name('caisse');
    Route::post('/caisse/creation','store')->name('caisse.store');
    Route::get('/caisse/{id}/detail','show')->name('caisse.show');
    Route::get('/caisse/{id}/edit','edit')->name('caisse.edit');
    Route::post('/caisse/{id}/update','update')->name('caisse.update');

    Route::get('/caisse/operation','operation')->name('caisse.operation');
    Route::post('/caisse/{id}/ouverture','ouverture')->name('caisse.ouverture');
    Route::post('/caisse/{id}/fermeture','fermeture')->name('caisse.fermeture');

    Route::get('/caisse/attribution','attribution')->name('caisse.attribution');
    Route::get('/caisse/encaissement','encaissement')->name('caisse.encaissement');

    Route::post('/caisse/attribution_valider','attribution_valider')->name('caisse.attribution.valider');
    Route::get('/caisse/{id}/encaissement_valider','encaissement_valider')->name('caisse.encaissement.valider');

    Route::post('/caisse/{id}/fermeture','fermeture')->name('caisse.fermeture');

    Route::get('/caisse/rapport','rapport_caisse')->name('caisse.rapport');
});

Route::middleware('auth')->controller(AgenceUserController::class)->group(function(){
    Route::get('/agence_user','index')->name('agence_user');
    Route::post('/agence_user/creation','store')->name('agence_user.store');
    Route::get('/agence_user/{id}/detail','show')->name('agence_user.show');
    Route::get('/agence_user/{id}/edit','edit')->name('agence_user.edit');
    Route::post('/agence_user/{id}/update','update')->name('agence_user.update');
    Route::post('/agence_user/select','listUser')->name('agence_user.select');
    Route::get('/agence/select/{id}/annuler','asso_agence_annuler')->name('annuler.agence.select');
    Route::post('/agence/edit/devise','edit_devise')->name('edit.devise');
});

Route::middleware('auth')->controller(CaisseUserController::class)->group(function(){
    Route::get('/caisse_user','index')->name('caisse_user');
    Route::post('/caisse_user/creation','store')->name('caisse_user.store');
    Route::get('/caisse_user/{id}/detail','show')->name('caisse_user.show');
    Route::get('/caisse_user/{id}/edit','edit')->name('caisse_user.edit');
    Route::post('/caisse_user/{id}/update','update')->name('caisse_user.update');
    Route::post('/caisse/select/user','utilisateur_agence')->name('user.select');
    Route::post('/caisse/select/caisse','utilisateur_caisse')->name('caisse.select');
    Route::get('/caisse/select/{id}/annuler','asso_caisse_annuler')->name('annuler.caisse.select');
});

Route::middleware('auth')->controller(ClientController::class)->group(function(){
    Route::get('/client','index')->name('client');
    Route::post('/client/creation','store')->name('client.store');
    Route::get('/client/{id}/detail','show')->name('client.show');
    Route::get('/client/{id}/edit','edit')->name('client.edit');
    Route::post('/client/{id}/update','update')->name('client.update');
});

Route::middleware('auth')->controller(FournisseurController::class)->group(function(){
    Route::get('/fournisseur','index')->name('fournisseur');
    Route::post('/fournisseur/creation','store')->name('fournisseur.store');
    Route::get('/fournisseur/{id}/detail','show')->name('fournisseur.show');
    Route::get('/fournisseur/{id}/edit','edit')->name('fournisseur.edit');
    Route::post('/fournisseur/{id}/update','update')->name('fournisseur.update');
});

Route::middleware('auth')->controller(EnvoiController::class)->group(function(){
    Route::get('/envoi','index')->name('envoi');
    Route::post('/envoi/numero','numero_client')->name('envoi.numero_client');
    Route::post('/envoi/creation','store')->name('envoi.store');
    Route::get('/envoi/{id}/detail','show')->name('envoi.show');
    Route::post('/envoi/info','info_destination')->name('envoi.info');
    Route::get('/envoi/{id}/print','print')->name('envoi.print');
});

Route::middleware('auth')->controller(RetraitController::class)->group(function(){
    Route::get('/retrait','index')->name('retrait');
    Route::post('/retrait/code','code_envoi')->name('retrait.code_envoi');
    Route::post('/retrait/{id}/update','update')->name('retrait.update');
    Route::get('/retrait/{id}/edit','edit')->name('retrait.edit');
    Route::get('/retrait/{id}/detail','show')->name('retrait.show');
    Route::get('/retrait/{id}/print','print')->name('retrait.print');
});

Route::middleware('auth')->controller(AutresOperationController::class)->group(function(){

    Route::get('/operation','index')->name('operation');
    Route::post('/creer/operation','store')->name('operation.store');
    Route::get('/operation/{id}/detail','show')->name('operation.show');
    Route::get('/operation/{id}/edit','edit')->name('operation.edit');
    Route::post('/operation/{id}/update','update')->name('operation.update');

});

Route::middleware('auth')->controller(CategorieProduitController::class)->group(function(){
    Route::get('/categorie_produit','index')->name('categorie_produit');
    Route::post('/categorie_produit/create','create')->name('categorie_produit.create');
    Route::post('/categorie_produit/store','store')->name('categorie_produit.store');
    Route::get('/categorie_produit/{id}/detail','show')->name('categorie_produit.show');
    Route::get('/categorie_produit/{id}/edit','edit')->name('categorie_produit.edit');
    Route::post('/categorie_produit/{id}/update','update')->name('categorie_produit.update');
});

Route::middleware('auth')->controller(ProduitController::class)->group(function(){
    Route::get('/produit','index')->name('produit');
    Route::post('/produit/create','create')->name('produit.create');
    Route::post('/produit/store','store')->name('produit.store');
    Route::get('/produit/{id}/detail','show')->name('produit.show');
    Route::get('/produit/{id}/edit','edit')->name('produit.edit');
    Route::post('/produit/{id}/update','update')->name('produit.update');
});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| controller de cash
|
*/

Route::middleware('auth')->controller(TrancheTarifController::class)->group(function(){

    Route::get('/tarif','index')->name('tarif');
    Route::post('/creer/tarif','store')->name('tarif.store');

});

Route::middleware('auth')->controller(DeviseController::class)->group(function(){

    Route::get('/devise','index')->name('devise');
    Route::post('/creer/devise','store')->name('devise.store');
    Route::get('/devise/{id}/detail','show')->name('devise.show');
    Route::get('/devise/{id}/edit','edit')->name('devise.edit');
    Route::post('/devise/{id}/update','update')->name('devise.update');
    Route::get('/devise/taux','taux')->name('devise.taux');
    Route::Post('/devise/agence','agence')->name('devise.agence');

});
Route::middleware('auth')->controller(AchatDeviseController::class)->group(function(){

    Route::get('/achat_devise','index')->name('achat_devise');
    Route::get('/achat_devise/{id}/detail','show')->name('achat_devise.show');
    Route::get('/achat_devise/{id}/edit','edit')->name('achat_devise.edit');
    Route::get('/achat_devise/{id}/print','print')->name('achat_devise.print');
    Route::post('/achat_devise/{id}/update','update')->name('achat_devise.update');
    Route::post('/achat_devise/client','client')->name('achat_devise.client');
    Route::post('/taux/achat_devise','taux_devise')->name('achat_devise.taux');
    Route::post('/stock/achat_devise','stock_devise')->name('achat_devise.stock');
    Route::post('/creer/achat_devise','store')->name('achat_devise.store');

});

Route::middleware('auth')->controller(VenteDeviseController::class)->group(function(){


    Route::get('/vente_devise','index')->name('vente_devise');
    Route::get('/vente_devise/{id}/detail','show')->name('vente_devise.show');
    Route::get('/vente_devise/{id}/edit','edit')->name('vente_devise.edit');
    Route::get('/vente_devise/{id}/print','print')->name('vente_devise.print');
    Route::post('/vente_devise/{id}/update','update')->name('vente_devise.update');
    Route::post('/vente_devise/client','client')->name('vente_devise.client');
    Route::post('/taux/vente_devise','taux_devise')->name('vente_devise.taux');
    Route::post('/stock/vente_devise','stock_devise')->name('vente_devise.stock');
    Route::post('/creer/ventet_devise','store')->name('vente_devise.store');

});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| controller de investissement
|
*/
 Route::middleware('auth')->controller(InvestisseurController::class)->group(function(){

    Route::get('/investisseur','index')->name('investisseur');
    Route::get('/create/investisseur','create')->name('investisseur.create');
    Route::post('/store/investisseur','store')->name('investisseur.store');
    Route::get('/investisseur/{id}/show','show')->name('investisseur.show');
    Route::get('/investisseur/{id}/edit','edit')->name('investisseur.edit');
    Route::post('/investisseur/{id}/update','update')->name('investisseur.update');
    Route::get('/investisseur/code','code')->name('investisseur.code');
    Route::post('/activer_desactiver/investisseur','activer_desactiver')->name('investisseur.activer_desactiver');
    Route::get('/consultation/compte','consultation')->name('investisseur.consultation');
    Route::post('/consulter/compte','consulter')->name('investisseur.consulter');

});

Route::middleware('auth')->controller(VersementInvestisseurController::class)->group(function(){

    Route::get('/i_versement','index')->name('i_versement');
    Route::post('/i_versement/versement','versement')->name('i_versement.versement');
    Route::post('/i_versement/{id}/operation','operation')->name('i_versement.operation');
    Route::post('/creer/{id}/i_versement','store')->name('i_versement.store');
    Route::get('/i_versement/{id}/show','show')->name('i_versement.show');
    Route::get('/i_versement/{id}/edit','edit')->name('i_versement.edit');
    Route::post('/i_versement/{id}/update','update')->name('i_versement.update');
    Route::get('/i_versement/{id}/print','print')->name('i_versement.print');

});

Route::middleware('auth')->controller(RetraitInvestisseurController::class)->group(function(){

    Route::get('/i_retrait','index')->name('i_retrait');
    Route::post('/i_retrait/versement','retrait')->name('i_retrait.retrait');
    Route::post('/i_retrait/{id}/operation','operation')->name('i_retrait.operation');
    Route::post('/creer/{id}/i_retrait','store')->name('i_retrait.store');
    Route::get('/i_retrait/{id}/show','show')->name('i_retrait.show');
    Route::get('/i_retrait/{id}/edit','edit')->name('i_retrait.edit');
    Route::post('/i_retrait/{id}/update','update')->name('i_retrait.update');
    Route::get('/i_retrait/{id}/print','print')->name('i_retrait.print');

});

Route::middleware('auth')->controller(RetraitDividendeController::class)->group(function(){

    Route::get('/d_retrait','index')->name('d_retrait');
    Route::post('/d_retrait/versement','retrait')->name('d_retrait.retrait');
    Route::post('/d_retrait/{id}/operation','operation')->name('d_retrait.operation');
    Route::post('/creer/{id}/d_retrait','store')->name('d_retrait.store');
    Route::get('/d_retrait/{id}/show','show')->name('d_retrait.show');
    Route::get('/d_retrait/{id}/edit','edit')->name('d_retrait.edit');
    Route::post('/d_retrait/{id}/update','update')->name('d_retrait.update');
    Route::get('/d_retrait/{id}/print','print')->name('d_retrait.print');

});

Route::middleware('auth')->controller(TypeActiviteInvestissementController::class)->group(function(){

    Route::get('/type_activite_investissement','index')->name('type_activite_investissement');
    Route::get('/type_activite_investissement/create','create')->name('type_activite_investissement.create');
    Route::post('/type_activite_investissement/store','store')->name('type_activite_investissement.store');
    Route::get('/type_activite_investissement/{id}/show','show')->name('type_activite_investissement.show');
    Route::get('/type_activite_investissement/{id}/edit','edit')->name('type_activite_investissement.edit');
    Route::post('/type_activite_investissement/{id}/update','update')->name('type_activite_investissement.update');
    Route::get('/type_activite_investissement/{id}/print','print')->name('type_activite_investissement.print');

});

Route::middleware('auth')->controller(ActiviteInvestissementController::class)->group(function(){

    Route::get('/activite_investissement','index')->name('activite_investissement');
    Route::get('/activite_investissement/valider','valider')->name('activite_investissement.valider');
    Route::get('/activite_investissement/terminer','terminer')->name('activite_investissement.terminer');
    Route::get('/{id}/activite_investissement/repartition','repartition')->name('activite_investissement.repartition');
    Route::post('/activite_investissement/repartie','repartie')->name('activite_investissement.repartie');
    Route::get('/activite_investissement/create','create')->name('activite_investissement.create');
    Route::post('/activite_investissement/store','store')->name('activite_investissement.store');
    Route::get('/activite_investissement/{id}/show','show')->name('activite_investissement.show');
    Route::get('/activite_investissement/{id}/edit','edit')->name('activite_investissement.edit');
    Route::post('/activite_investissement/{id}/update','update')->name('activite_investissement.update');
    Route::get('/activite_investissement/{id}/destroy','destroy')->name('activite_investissement.delete');
    Route::get('/activite_investissement/{id}/print','print')->name('activite_investissement.print');

});

Route::middleware('auth')->controller(DetailActiviteInvestissementController::class)->group(function(){

    Route::get('/detail_activite_investissement','index')->name('detail_activite_investissement');
    Route::get('/detail_activite_investissement/create','create')->name('detail_activite_investissement.create');
    Route::post('/detail_activite_investissement/store','store')->name('detail_activite_investissement.store');
    Route::get('/detail_activite_investissement/{id}/show','show')->name('detail_activite_investissement.show');
    Route::get('/detail_activite_investissement/{id}/edit','edit')->name('detail_activite_investissement.edit');
    Route::post('/detail_activite_investissement/{id}/update','update')->name('detail_activite_investissement.update');
    Route::get('/detail_activite_investissement/{id}/destroy','destroy')->name('detail_activite_investissement.delete');
    Route::get('/detail_activite_investissement/{id}/print','print')->name('detail_activite_investissement.print');

});

Route::middleware('auth')->controller(NatureOperationChargeController::class)->group(function(){

    Route::get('/nature_operation_charge','index')->name('nature_operation_charge');
    Route::get('/nature_operation_charge/create','create')->name('nature_operation_charge.create');
    Route::post('/nature_operation_charge/store','store')->name('nature_operation_charge.store');
    Route::get('/nature_operation_charge/{id}/show','show')->name('nature_operation_charge.show');
    Route::get('/nature_operation_charge/{id}/edit','edit')->name('nature_operation_charge.edit');
    Route::post('/nature_operation_charge/{id}/update','update')->name('nature_operation_charge.update');
    Route::get('/nature_operation_charge/{id}/destroy','destroy')->name('nature_operation_charge.delete');
    Route::get('/nature_operation_charge/{id}/print','print')->name('nature_operation_charge.print');

});

Route::middleware('auth')->controller(SecteurDepenseController::class)->group(function(){

    Route::get('/secteur_depense','index')->name('secteur_depense');
    Route::get('/secteur_depense/create','create')->name('secteur_depense.create');
    Route::post('/secteur_depense/store','store')->name('secteur_depense.store');
    Route::get('/secteur_depense/{id}/show','show')->name('secteur_depense.show');
    Route::get('/secteur_depense/{id}/edit','edit')->name('secteur_depense.edit');
    Route::post('/secteur_depense/{id}/update','update')->name('secteur_depense.update');
    Route::get('/secteur_depense/{id}/destroy','destroy')->name('secteur_depense.delete');
    Route::get('/secteur_depense/{id}/print','print')->name('secteur_depense.print');

});


Route::controller(PortailInvestisseurController::class)->group(function(){

    Route::get('/portail','index')->name('portail');
    Route::post('/portail/connect','connect')->name('portail.connect');
    Route::get('/profile/{id}/investisseur','profile_investisseur')->name('profile.investisseur');
    Route::post('/portail/inscription','store')->name('portail.store');
    Route::post('/portail/recuperation','recuperation')->name('portail.recuperation');
    Route::get('/inscrire','inscrire')->name('inscrire');

});

Route::middleware('auth')->controller(AchatVoitureController::class)->group(function(){


    Route::get('/achat_voiture','index')->name('achat_voiture');
    Route::get('/achat_voiture/{id}/detail','show')->name('achat_voiture.show');
    Route::get('/achat_voiture/{id}/edit','edit')->name('achat_voiture.edit');
    Route::get('/achat_voiture/{id}/print','print')->name('achat_voiture.print');
    Route::post('/achat_voiture/{id}/update','update')->name('achat_voiture.update');
    Route::post('/achat_voiture/client','client')->name('achat_voiture.client');
    Route::post('/creer/achat_voiture','store')->name('achat_voiture.store');

});

Route::middleware('auth')->controller(VenteVoitureController::class)->group(function(){


    Route::get('/vente_voiture','index')->name('vente_voiture');
    Route::get('/vente_voiture/{id}/detail','show')->name('vente_voiture.show');
    Route::get('/vente_voiture/{id}/edit','edit')->name('vente_voiture.edit');
    Route::get('/vente_voiture/{id}/print','print')->name('vente_voiture.print');
    Route::post('/vente_voiture/{id}/update','update')->name('vente_voiture.update');
    Route::post('/vente_voiture/client','client')->name('vente_voiture.client');
    Route::post('/creer/vente_voiture','store')->name('vente_voiture.store');

});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| controller de hotel
|
*/
Route::middleware('auth')->controller(TypeChambreController::class)->group(function(){

    Route::get('/type_chambre','index')->name('type_chambre');
    Route::post('/creer/type_chambre','store')->name('type_chambre.store');
    Route::get('/type_chambre/{id}/show','show')->name('type_chambre.show');
    Route::get('/type_chambre/{id}/edit','edit')->name('type_chambre.edit');
    Route::post('/type_chambre/{id}/update','update')->name('type_chambre.update');
    Route::get('/type_chambre/{id}/print','print')->name('type_chambre.print');

});

Route::middleware('auth')->controller(TypeServiceController::class)->group(function(){

    Route::get('/type_service','index')->name('type_service');
    Route::post('/creer/type_service','store')->name('type_service.store');
    Route::get('/type_service/{id}/show','show')->name('type_service.show');
    Route::get('/type_service/{id}/edit','edit')->name('type_service.edit');
    Route::post('/type_service/{id}/update','update')->name('type_service.update');
    Route::get('/type_service/{id}/print','print')->name('type_service.print');

});


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| controller de e-commerce
|
*/
Route::middleware('auth')->controller(EntrepotController::class)->group(function(){

    Route::get('/entrepot','index')->name('entrepot');
    Route::post('/creer/entrepot','store')->name('entrepot.store');
    Route::get('/entrepot/{id}/show','show')->name('entrepot.show');
    Route::get('/entrepot/{id}/edit','edit')->name('entrepot.edit');
    Route::post('/entrepot/{id}/update','update')->name('entrepot.update');
    Route::get('/entrepot/{id}/print','print')->name('entrepot.print');

});

Route::middleware('auth')->controller(CommandeController::class)->group(function(){

    Route::get('/commande','index')->name('commande');
    Route::get('/creer/commande','create')->name('commande.create');
    Route::post('/creer/commande','store')->name('commande.store');
    Route::get('/commande/{id}/show','show')->name('commande.show');
    Route::get('/commande/{id}/edit','edit')->name('commande.edit');
    Route::post('/commande/select','select_produit')->name('produit.select');
    Route::post('/commande/{id}/update','update')->name('commande.update');
    Route::get('/commande/{id}/delete','destroy')->name('commande.delete');
    Route::get('/commande/{id}/print','print')->name('commande.print');

});
Route::middleware('auth')->controller(DetailCommandeController::class)->group(function(){

    Route::get('/detail_commande','index')->name('detail_commande');
    Route::post('/creer/detail_commande','create')->name('detail_commande.create');
    Route::post('/creer/detail_commande','store')->name('detail_commande.store');
    Route::get('/detail_commande/{id}/show','show')->name('detail_commande.show');
    Route::get('/detail_commande/{id}/edit','edit')->name('detail_commande.edit');
    Route::post('/detail_commande/{id}/update','update')->name('detail_commande.update');
    Route::get('/detail_commande/{id}/print','print')->name('detail_commande.print');

});

Route::middleware('auth')->controller(DevisController::class)->group(function(){

    Route::get('/devis','index')->name('devis');
    Route::get('/creer/devis','create')->name('devis.create');
    Route::post('/creer/devis','store')->name('devis.store');
    Route::get('/devis/{id}/show','show')->name('devis.show');
    Route::get('/devis/{id}/edit','edit')->name('devis.edit');
    Route::post('/devis/{id}/update','update')->name('devis.update');
    Route::get('/devis/{id}/delete','destroy')->name('devis.delete');
    Route::get('/devis/{id}/print','print')->name('devis.print');

});

Route::middleware('auth')->controller(DetailDevisController::class)->group(function(){

    Route::get('/detail_devis','index')->name('detail_devis');
    Route::post('/creer/detail_devis','store')->name('detail_devis.store');
    Route::get('/detail_devis/{id}/show','show')->name('detail_devis.show');
    Route::get('/detail_devis/{id}/edit','edit')->name('detail_devis.edit');
    Route::post('/detail_devis/{id}/update','update')->name('detail_devis.update');
    Route::get('/detail_devis/{id}/print','print')->name('detail_devis.print');

});

Route::middleware('auth')->controller(LivrerController::class)->group(function(){

    Route::get('/livrer','index')->name('livrer');
    Route::post('/creer/livrer','store')->name('livrer.store');
    Route::get('/livrer/{id}/show','show')->name('livrer.show');
    Route::get('/livrer/{id}/edit','edit')->name('livrer.edit');
    Route::post('/livrer/{id}/update','update')->name('livrer.update');
    Route::post('/livrer/{id}/delete','destroy')->name('livrer.delete');
    Route::get('/livrer/{id}/print','print')->name('livrer.print');

});

Route::middleware('auth')->controller(DetailLivrerController::class)->group(function(){

    Route::get('/detail_livrer','index')->name('detail_livrer');
    Route::post('/creer/detail_livrer','store')->name('detail_livrer.store');
    Route::get('/detail_livrer/{id}/show','show')->name('detail_livrer.show');
    Route::get('/detail_livrer/{id}/edit','edit')->name('detail_livrer.edit');
    Route::post('/detail_livrer/{id}/update','update')->name('detail_livrer.update');
    Route::get('/detail_livrer/{id}/print','print')->name('detail_livrer.print');

});

Route::middleware('auth')->controller(FactureController::class)->group(function(){

    Route::get('/facture','index')->name('facture');
    Route::post('/creer/facture','store')->name('facture.store');
    Route::get('/facture/{id}/show','show')->name('facture.show');
    Route::get('/facture/{id}/edit','edit')->name('facture.edit');
    Route::post('/facture/{id}/update','update')->name('facture.update');
    Route::get('/facture/{id}/print','print')->name('facture.print');

});

Route::middleware('auth')->controller(DetailFactureController::class)->group(function(){

    Route::get('/detail_facture','index')->name('detail_facture');
    Route::post('/creer/detail_facture','store')->name('detail_facture.store');
    Route::get('/detail_facture/{id}/show','show')->name('detail_facture.show');
    Route::get('/detail_facture/{id}/edit','edit')->name('detail_facture.edit');
    Route::post('/detail_facture/{id}/update','update')->name('detail_facture.update');
    Route::get('/detail_facture/{id}/print','print')->name('detail_facture.print');

});


Route::middleware('auth')->controller(InventaireStockController::class)->group(function(){

    Route::get('/inventaire_stock','index')->name('inventaire_stock');
    Route::post('/creer/inventaire_stock','store')->name('inventaire_stock.store');
    Route::get('/inventaire_stock/{id}/show','show')->name('inventaire_stock.show');
    Route::get('/inventaire_stock/{id}/edit','edit')->name('inventaire_stock.edit');
    Route::post('/inventaire_stock/{id}/update','update')->name('inventaire_stock.update');
    Route::get('/inventaire_stock/{id}/print','print')->name('inventaire_stock.print');

});

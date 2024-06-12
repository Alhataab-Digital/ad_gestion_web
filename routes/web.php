<?php

// use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Agence\AgenceController as AgenceAgenceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\UserController;

use App\Http\Controllers\SocieteController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Agence\AgenceController;
use App\Http\Controllers\Agence\AgenceUserController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Caisse\CaisseController;
use App\Http\Controllers\Caisse\CaisseUserController;
use App\Http\Controllers\Banque\BanqueController;
use App\Http\Controllers\CabinetAssurance\CategorieController;
use App\Http\Controllers\CabinetAssurance\ClasseController;
use App\Http\Controllers\CabinetAssurance\DureeController;
use App\Http\Controllers\CabinetAssurance\EnergieController;
use App\Http\Controllers\CabinetAssurance\GenreController;
use App\Http\Controllers\CabinetAssurance\GroupeController;
use App\Http\Controllers\CabinetAssurance\MarqueController;
use App\Http\Controllers\CabinetAssurance\PrimeNetController;
use App\Http\Controllers\CabinetAssurance\PuissanceController;
use App\Http\Controllers\CabinetAssurance\UsageController;
use App\Http\Controllers\CabinetAssurance\ZoneController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\Caisse\AutresOperationController;
use App\Http\Controllers\CategorieProduitController;
use App\Http\Controllers\ProduitController;


use App\Http\Controllers\MoneyChange\TrancheTarifController;
use App\Http\Controllers\MoneyChange\DeviseController;
use App\Http\Controllers\MoneyChange\AchatDeviseController;
use App\Http\Controllers\MoneyChange\VenteDeviseController;
use App\Http\Controllers\MoneyChange\EnvoiController;
use App\Http\Controllers\MoneyChange\RetraitController;



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
use App\Http\Controllers\Investissement\AchatVehiculeController;
use App\Http\Controllers\Investissement\VenteVehiculeController;
use App\Http\Controllers\Investissement\ActiviteVehiculeController;
use App\Http\Controllers\Investissement\DetailActiviteVehiculeController;
use App\Http\Controllers\Investissement\CommandeController;
use App\Http\Controllers\Investissement\DetailCommandeController;
use App\Http\Controllers\Investissement\LivrerController;
use App\Http\Controllers\Investissement\DetailLivrerController;
use App\Http\Controllers\Investissement\DevisController;
use App\Http\Controllers\Investissement\DetailDevisController;
use App\Http\Controllers\Investissement\FactureController;
use App\Http\Controllers\Investissement\DetailFactureController;
use App\Http\Controllers\Investissement\ReglementFactureController;


use App\Http\Controllers\Hotel\TypeChambreController;
use App\Http\Controllers\Hotel\TypeServiceController;



use App\Http\Controllers\Stock\EntrepotController;
use App\Http\Controllers\Stock\InventaireStockController;


use App\Http\Controllers\Detenu\DetenuController;
use App\Http\Controllers\EspaceProjetController;
use App\Livewire\CabinetMedical\CategorieMedicale;
/*
 --------------------------
|Controller livewire
---------------------------
*/

use App\Livewire\CabinetMedical\TarifMedical;
use App\Livewire\CabinetMedical\TarifMedicalEdit;
use App\Livewire\CabinetMedical\Medecin;
use App\Livewire\CabinetMedical\MedecinDossier;
use App\Livewire\CabinetMedical\MedecinEdit;
use App\Livewire\CabinetMedical\Patient;
use App\Livewire\CabinetMedical\PatientDossier;
use App\Livewire\CabinetMedical\PatientEdit;
use App\Livewire\CabinetMedical\Consultation;
use App\Livewire\CabinetMedical\ContratAssurance;
use App\Livewire\CabinetMedical\DossierConsultation;
use App\Livewire\CabinetMedical\DossierRendezVousConsultation;
use App\Livewire\CabinetMedical\EditCategorieMedicale;
use App\Livewire\CabinetMedical\EditTarifConsultation;
use App\Livewire\CabinetMedical\EditTypeConcultation;
use App\Livewire\CabinetMedical\Examen;
use App\Livewire\CabinetMedical\FacturationConsultation;
use App\Livewire\CabinetMedical\MaisonAssurance;
use App\Livewire\CabinetMedical\MaisonAssuranceEdit;
use App\Livewire\CabinetMedical\MedecinUser;
use App\Livewire\CabinetMedical\Medicament;
use App\Livewire\CabinetMedical\PlanificationMedecin;
use App\Livewire\CabinetMedical\PriseEnCharge;
use App\Livewire\CabinetMedical\RecuConsultation;
use App\Livewire\CabinetMedical\RendezVousConsultation;
use App\Livewire\CabinetMedical\ResultatConsultation;
use App\Livewire\CabinetMedical\SpecialiteMedicale;
use App\Livewire\CabinetMedical\TarifConsultation;
use App\Livewire\CabinetMedical\TraitementConsultation;
use App\Livewire\CabinetMedical\TypeConsultation;
use App\Livewire\CabinetMedical\TypeExamen;

use Livewire\Livewire;

// Enregistrer une route de mise à jour personnalisée pour Livewire
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle)
        ->middleware(['web', 'auth', 'localization']); // Ajouter des middlewares supplémentaires
});
/*
 --------------------------
|Controller livewire end
---------------------------
*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

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
    Route::get('/','index');
    Route::get('/login','login')->name('login');
    Route::post('/store','store')->name('login.store');
    Route::get('/logout','logout')->name('logout');
    Route::get('/user_connexion','user_connexion')->name('users.user_connexion');
    Route::post('/restore_connexion','restore_connexion')->name('users.restore_connexion');
    Route::get('/code','code')->name('users.code');
    Route::post('/valider/code','validerCode')->name('users.valider.code');
});


Route::controller(RegisterController::class)->group(function(){

    Route::get('/registre/{id}','create')->name('registre');
    Route::post('/registre/store/{id}','store')->name('registre.store');

});
Route::controller(EspaceProjetController::class)->group(function(){

    Route::get('/espace/projet','index')->name('espace.projet');

});
Route::middleware(['auth','initier'])->controller(HomeController::class)->group(function(){
    Route::get('/home','index')->name('home');
    Route::get('/{id}/activer','store')->name('activer.environnement');
});

Route::middleware(['auth','initier'])->controller(RoleController::class)->group(function(){
    Route::get('/role','index')->name('role');
    Route::get('/role/{id}/edit','edit')->name('role.edit');
    Route::post('/role/{id}/update','update')->name('role.update');
});

Route::middleware(['auth','initier'])->controller(UserController::class)->group(function(){
    Route::get('/users/index','index')->name('users.index');
    Route::get('/users/online','online')->name('users.online');
    Route::get('/users/filelog','filelog')->name('users.filelog');
    Route::post('/users/store','store')->name('users.store');
    Route::get('/users/{id}/edit','edit')->name('users.edit');
    Route::post('/users/{id}/update','update')->name('users.update');
    Route::get('/users/{id}/active','active')->name('users.active');
    Route::get('/users/{id}/inactive','inactive')->name('users.inactive');
    Route::post('/users/{id}/role','role')->name('users.role');
    Route::post('/users/{id}/password','password')->name('users.password');
    Route::post('/users/permission','permission')->name('users.permission');
});

Route::middleware(['auth','initier'])->controller(SocieteController::class)->group(function(){
    Route::get('/societe','index')->name('workspace');
    Route::post('/societe/creation','store')->name('workspace.store');
    Route::get('/societe/{id}/detail','show')->name('workspace.show');
    Route::get('/societe/{id}/edit','edit')->name('workspace.edit');
    Route::post('/societe/{id}/update','update')->name('workspace.update');
    Route::post('/societe/logo/{id}/update','update_logo')->name('logo.update');
});

Route::middleware(['auth','initier'])->controller(RegionController::class)->group(function(){
    Route::get('/region','index')->name('region');
    Route::post('/region/creation','store')->name('region.store');
    Route::get('/region/{id}/detail','show')->name('region.show');
    Route::get('/region/{id}/edit','edit')->name('region.edit');
    Route::post('/region/{id}/update','update')->name('region.update');
});

Route::middleware(['auth','initier'])->controller(ProfileController::class)->group(function(){
    Route::get('/profile','index')->name('profile');
    Route::post('/changer/password','store')->name('profile.store');
});

Route::middleware(['auth','initier'])->controller(RoleController::class)->group(function(){
    Route::get('/role','index')->name('role');
    Route::post('/role/creation','store')->name('role.store');
    Route::get('/role/{id}/detail','show')->name('role.show');
    Route::get('/role/{id}/edit','edit')->name('role.edit');
    Route::post('/role/{id}/update','update')->name('role.update');
});

Route::middleware(['auth','initier'])->controller(AgenceController::class)->group(function(){
    Route::get('/agence','index')->name('agence');
    Route::post('/agence/creation','store')->name('agence.store');
    Route::get('/agence/{id}/detail','show')->name('agence.show');
    Route::get('/agence/{id}/edit','edit')->name('agence.edit');
    Route::post('/agence/{id}/update','update')->name('agence.update');
    Route::post('/agence/devise','devise')->name('agence.devise');
    Route::post('/agence/code','region_code')->name('agence_region.code');
});

Route::middleware(['auth','initier'])->controller(BanqueController::class)->group(function(){
    Route::get('/banque','index')->name('banque');
    Route::post('/banque/creation','store')->name('banque.store');
    Route::get('/banque/{id}/detail','show')->name('banque.show');
    Route::get('/banque/{id}/edit','edit')->name('banque.edit');
    Route::post('/banque/{id}/update','update')->name('banque.update');

    Route::get('/banque/operation','operation')->name('banque.operation');
    Route::post('/banque/{id}/ouverture','ouverture')->name('banque.ouverture');
    Route::post('/banque/{id}/fermeture','fermeture')->name('banque.fermeture');

    Route::get('/banque/virement','virement')->name('banque.virement');
    Route::get('/banque/depot','depot')->name('banque.depot');
    Route::get('/banque/retrait','retrait')->name('banque.retrait');

    Route::get('/banque/{id}/virement_valider','virement_valider')->name('banque.virement.valider');
    Route::get('/banque/{id}/depot_valider','depot_valider')->name('banque.depot.valider');
    Route::get('/banque/{id}/retrait_valider','retrait_valider')->name('banque.retrait.valider');

    Route::post('/banque/virement_create','virement_create')->name('banque.virement.create');
    Route::post('/banque/depot_create','depot_create')->name('banque.depot.create');
    Route::post('/banque/retrait_create','retrait_create')->name('banque.retrait.create');

    Route::get('/banque/{id}/virement_edit','virement_edit')->name('banque.virement.edit');
    Route::get('/banque/{id}/depot_edit','depot_edit')->name('banque.depot.edit');
    Route::get('/banque/{id}/retrait_edit','retrait_edit')->name('banque.retrait.edit');

    Route::post('/banque/virement_modifier','virement_modifier')->name('banque.virement.modifier');
    Route::post('/banque/depot_modifier','depot_modifier')->name('banque.depot.modifier');
    Route::post('/banque/retrait_modifier','retrait_modifier')->name('banque.retrait.modifier');

    Route::get('/banque/{id}/virement_supprimer','virement_supprimer')->name('banque.virement.delete');
    Route::get('/banque/{id}/depot_supprimer','depot_supprimer')->name('banque.depot.delete');
    Route::get('/banque/{id}/retrait_supprimer','retrait_supprimer')->name('banque.retrait.delete');

    Route::get('/banque/rapporchement','rapprochement')->name('banque.rapprochement');

    Route::post('/banque/rapport','rapport_banque')->name('banque.rapport');
});

Route::middleware(['auth','initier'])->controller(CaisseController::class)->group(function(){
    Route::get('/caisse','index')->name('caisse');
    Route::post('/caisse/creation','store')->name('caisse.store');
    Route::get('/caisse/{id}/detail','show')->name('caisse.show');
    Route::get('/caisse/{id}/edit','edit')->name('caisse.edit');
    Route::post('/caisse/{id}/update','update')->name('caisse.update');

    Route::get('/caisse/operation','operation')->name('caisse.operation');
    Route::post('/caisse/{id}/ouverture','ouverture')->name('caisse.ouverture');
    Route::post('/caisse/{id}/fermeture','fermeture')->name('caisse.fermeture');

    Route::get('/caisse/attribution','attribution')->name('caisse.attribution');
    Route::get('/caisse/attribution_externe','attribution_externe')->name('caisse.attribution_externe');
    Route::get('/caisse/encaissement','encaissement')->name('caisse.encaissement');

    Route::post('/caisse/attribution_valider','attribution_valider')->name('caisse.attribution.valider');
    Route::post('/caisse/attribution_externe_valider','attribution_externe_valider')->name('caisse.attribution_externe.valider');
    Route::get('/caisse/{id}/attribution_edit','attribution_edit')->name('caisse.attribution.edit');
    Route::get('/caisse/{id}/attribution_externe_edit','attribution_externe_edit')->name('caisse.attribution_externe.edit');
    Route::post('/caisse/attribution_modifier','attribution_modifier')->name('caisse.attribution.modifier');
    Route::post('/caisse/attribution_externe_modifier','attribution_externe_modifier')->name('caisse.attribution_externe.modifier');
    Route::get('/caisse/{id}/attribution_supprimer','attribution_supprimer')->name('caisse.attribution.delete');
    Route::get('/caisse/{id}/encaissement_valider','encaissement_valider')->name('caisse.encaissement.valider');

    Route::post('/caisse/{id}/fermeture','fermeture')->name('caisse.fermeture');

    Route::get('/caisse/rapport','rapport_caisse')->name('caisse.rapport');
});

Route::middleware(['auth','initier'])->controller(AgenceUserController::class)->group(function(){
    Route::get('/agence_user','index')->name('agence_user');
    Route::post('/agence_user/creation','store')->name('agence_user.store');
    Route::get('/agence_user/{id}/detail','show')->name('agence_user.show');
    Route::get('/agence_user/{id}/edit','edit')->name('agence_user.edit');
    Route::post('/agence_user/{id}/update','update')->name('agence_user.update');
    Route::post('/agence_user/select','listUser')->name('agence_user.select');
    Route::get('/agence/select/{id}/annuler','asso_agence_annuler')->name('annuler.agence.select');
    Route::post('/agence/edit/devise','edit_devise')->name('edit.devise');
});

Route::middleware(['auth','initier'])->controller(CaisseUserController::class)->group(function(){
    Route::get('/caisse_user','index')->name('caisse_user');
    Route::post('/caisse_user/creation','store')->name('caisse_user.store');
    Route::get('/caisse_user/{id}/detail','show')->name('caisse_user.show');
    Route::get('/caisse_user/{id}/edit','edit')->name('caisse_user.edit');
    Route::post('/caisse_user/{id}/update','update')->name('caisse_user.update');
    Route::post('/caisse/select/user','utilisateur_agence')->name('user.select');
    Route::post('/caisse/select/caisse','utilisateur_caisse')->name('caisse.select');
    Route::get('/caisse/select/{id}/annuler','asso_caisse_annuler')->name('annuler.caisse.select');
});

Route::middleware(['auth','initier'])->controller(ClientController::class)->group(function(){
    Route::get('/client','index')->name('client');
    Route::post('/client/creation','store')->name('client.store');
    Route::get('/client/{id}/detail','show')->name('client.show');
    Route::get('/client/{id}/edit','edit')->name('client.edit');
    Route::post('/client/{id}/update','update')->name('client.update');
});

Route::middleware(['auth','initier'])->controller(FournisseurController::class)->group(function(){
    Route::get('/fournisseur','index')->name('fournisseur');
    Route::post('/fournisseur/creation','store')->name('fournisseur.store');
    Route::get('/fournisseur/{id}/detail','show')->name('fournisseur.show');
    Route::get('/fournisseur/{id}/edit','edit')->name('fournisseur.edit');
    Route::post('/fournisseur/{id}/update','update')->name('fournisseur.update');
});

Route::middleware(['auth','initier'])->controller(EnvoiController::class)->group(function(){
    Route::get('/envoi','index')->name('envoi');
    Route::post('/envoi/numero','numero_client')->name('envoi.numero_client');
    Route::post('/envoi/creation','store')->name('envoi.store');
    Route::get('/envoi/{id}/detail','show')->name('envoi.show');
    Route::post('/envoi/info','info_destination')->name('envoi.info');
    Route::get('/envoi/{id}/print','print')->name('envoi.print');
    Route::post('/envoi/region/code','region_code')->name('envoi_devise.code');
});

Route::middleware(['auth','initier'])->controller(RetraitController::class)->group(function(){
    Route::get('/retrait','index')->name('retrait');
    Route::post('/retrait/code','code_envoi')->name('retrait.code_envoi');
    Route::post('/retrait/{id}/update','update')->name('retrait.update');
    Route::get('/retrait/{id}/edit','edit')->name('retrait.edit');
    Route::get('/retrait/{id}/detail','show')->name('retrait.show');
    Route::get('/retrait/{id}/print','print')->name('retrait.print');
    Route::post('/retrait/region/code','region_code')->name('retrait_devise.code');
});

Route::middleware(['auth','initier'])->controller(AutresOperationController::class)->group(function(){

    Route::get('/operation','index')->name('operation');
    Route::post('/creer/operation','store')->name('operation.store');
    Route::get('/operation/{id}/detail','show')->name('operation.show');
    Route::get('/operation/{id}/edit','edit')->name('operation.edit');
    Route::post('/operation/{id}/update','update')->name('operation.update');
    Route::get('/operation/{id}/delete','destroy')->name('operation.delete');

});

Route::middleware(['auth','initier'])->controller(CategorieProduitController::class)->group(function(){
    Route::get('/categorie_produit','index')->name('categorie_produit');
    Route::post('/categorie_produit/create','create')->name('categorie_produit.create');
    Route::post('/categorie_produit/store','store')->name('categorie_produit.store');
    Route::get('/categorie_produit/{id}/detail','show')->name('categorie_produit.show');
    Route::get('/categorie_produit/{id}/edit','edit')->name('categorie_produit.edit');
    Route::post('/categorie_produit/{id}/update','update')->name('categorie_produit.update');
});

Route::middleware(['auth','initier'])->controller(ProduitController::class)->group(function(){
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
| controller de money_change
|
*/

Route::middleware(['auth','initier'])->controller(TrancheTarifController::class)->group(function(){

    Route::get('/tarif','index')->name('tarif');
    Route::post('/creer/tarif','store')->name('tarif.store');

});

Route::middleware(['auth','initier'])->controller(DeviseController::class)->group(function(){

    Route::get('/devise','index')->name('devise');
    Route::post('/creer/devise','store')->name('devise.store');
    Route::get('/devise/{id}/detail','show')->name('devise.show');
    Route::get('/devise/{id}/edit','edit')->name('devise.edit');
    Route::post('/devise/{id}/update','update')->name('devise.update');
    Route::get('/devise/taux','taux')->name('devise.taux');
    Route::Post('/devise/agence','agence')->name('devise.agence');

});
Route::middleware(['auth','initier'])->controller(AchatDeviseController::class)->group(function(){

    Route::get('/achat_devise','index')->name('achat_devise');
    Route::get('/achat_devise/{id}/detail','show')->name('achat_devise.show');
    Route::get('/achat_devise/{id}/edit','edit')->name('achat_devise.edit');
    Route::get('/achat_devise/{id}/print','print')->name('achat_devise.print');
    Route::post('/achat_devise/{id}/update','update')->name('achat_devise.update');
    Route::post('/achat_devise/client','client')->name('achat_devise.client');
    Route::post('/taux/achat_devise','taux_devise')->name('achat_devise.taux');
    Route::post('/stock/achat_devise','stock_devise')->name('achat_devise.stock');
    Route::post('/creer/achat_devise','store')->name('achat_devise.store');
    Route::post('/achat/region/code','region_code')->name('achat_devise.code');

});

Route::middleware(['auth','initier'])->controller(VenteDeviseController::class)->group(function(){


    Route::get('/vente_devise','index')->name('vente_devise');
    Route::get('/vente_devise/{id}/detail','show')->name('vente_devise.show');
    Route::get('/vente_devise/{id}/edit','edit')->name('vente_devise.edit');
    Route::get('/vente_devise/{id}/print','print')->name('vente_devise.print');
    Route::post('/vente_devise/{id}/update','update')->name('vente_devise.update');
    Route::post('/vente_devise/client','client')->name('vente_devise.client');
    Route::post('/taux/vente_devise','taux_devise')->name('vente_devise.taux');
    Route::post('/stock/vente_devise','stock_devise')->name('vente_devise.stock');
    Route::post('/creer/ventet_devise','store')->name('vente_devise.store');
    Route::post('/vente/region/code','region_code')->name('vente_devise.code');

});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| controller de investissement
|
*/
 Route::middleware(['auth','initier'])->controller(InvestisseurController::class)->group(function(){

    Route::get('/investisseur','index')->name('investisseur');
    Route::get('/create/investisseur','create')->name('investisseur.create');
    Route::post('/store/investisseur','store')->name('investisseur.store');
    Route::get('/investisseur/{id}/show','show')->name('investisseur.show');
    Route::get('/investisseur/{id}/edit','edit')->name('investisseur.edit');
    Route::post('/investisseur/{id}/password','password')->name('investisseur.password');
    Route::post('/investisseur/{id}/update','update')->name('investisseur.update');
    Route::get('/investisseur/code','code')->name('investisseur.code');
    Route::post('/activer_desactiver/investisseur','activer_desactiver')->name('investisseur.activer_desactiver');
    Route::get('/consultation/compte','consultation')->name('investisseur.consultation');
    Route::post('/consulter/compte','consulter')->name('investisseur.consulter');

});

Route::middleware(['auth','initier'])->controller(VersementInvestisseurController::class)->group(function(){

    Route::get('/i_versement','index')->name('i_versement');
    Route::post('/i_versement/versement','versement')->name('i_versement.versement');
    Route::post('/i_versement/{id}/operation','operation')->name('i_versement.operation');
    Route::post('/creer/{id}/i_versement','store')->name('i_versement.store');
    Route::get('/i_versement/{id}/show','show')->name('i_versement.show');
    Route::get('/i_versement/{id}/edit','edit')->name('i_versement.edit');
    Route::post('/i_versement/{id}/update','update')->name('i_versement.update');
    Route::get('/i_versement/{id}/print','print')->name('i_versement.print');

});

Route::middleware(['auth','initier'])->controller(RetraitInvestisseurController::class)->group(function(){

    Route::get('/i_retrait','index')->name('i_retrait');
    Route::post('/i_retrait/investissement','retrait')->name('i_retrait.retrait');
    Route::post('/i_retrait/{id}/operation','operation')->name('i_retrait.operation');
    Route::post('/creer/{id}/i_retrait','store')->name('i_retrait.store');
    Route::get('/i_retrait/{id}/show','show')->name('i_retrait.show');
    Route::get('/i_retrait/{id}/edit','edit')->name('i_retrait.edit');
    Route::post('/i_retrait/{id}/update','update')->name('i_retrait.update');
    Route::get('/i_retrait/{id}/print','print')->name('i_retrait.print');

});

Route::middleware(['auth','initier'])->controller(RetraitDividendeController::class)->group(function(){

    Route::get('/d_retrait','index')->name('d_retrait');
    Route::post('/d_retrait/dividende','retrait')->name('d_retrait.retrait');
    Route::post('/d_retrait/{id}/operation','operation')->name('d_retrait.operation');
    Route::post('/creer/{id}/d_retrait','store')->name('d_retrait.store');
    Route::get('/d_retrait/{id}/show','show')->name('d_retrait.show');
    Route::get('/d_retrait/{id}/edit','edit')->name('d_retrait.edit');
    Route::post('/d_retrait/{id}/update','update')->name('d_retrait.update');
    Route::get('/d_retrait/{id}/print','print')->name('d_retrait.print');

});

Route::middleware(['auth','initier'])->controller(TypeActiviteInvestissementController::class)->group(function(){

    Route::get('/type_activite_investissement','index')->name('type_activite_investissement');
    Route::get('/type_activite_investissement/create','create')->name('type_activite_investissement.create');
    Route::post('/type_activite_investissement/store','store')->name('type_activite_investissement.store');
    Route::get('/type_activite_investissement/{id}/show','show')->name('type_activite_investissement.show');
    Route::get('/type_activite_investissement/{id}/edit','edit')->name('type_activite_investissement.edit');
    Route::post('/type_activite_investissement/{id}/update','update')->name('type_activite_investissement.update');
    Route::get('/type_activite_investissement/{id}/print','print')->name('type_activite_investissement.print');

});

Route::middleware(['auth','initier'])->controller(ActiviteInvestissementController::class)->group(function(){

    Route::get('/activite_investissement','index')->name('activite_investissement');
    Route::get('/activite_investissement/valider','valider')->name('activite_investissement.valider');
    Route::get('/activite_investissement/terminer','terminer')->name('activite_investissement.terminer');

    Route::post('/activite_investissement/repartie','repartie')->name('activite_investissement.repartie');
    Route::post('/activite_investissement/initier','initier')->name('activite_investissement.initier');
    Route::get('/{id}/activite_investissement/redemarrer','redemarrer')->name('activite_investissement.redemarrer');
    Route::get('/{id}/activite_investissement/repartition','repartition')->name('activite_investissement.repartition');
    Route::get('/activite_investissement/create','create')->name('activite_investissement.create');

    Route::post('/activite_investissement/store','store')->name('activite_investissement.store');
    Route::get('/activite_investissement/{id}/show','show')->name('activite_investissement.show');
    Route::get('/activite_investissement/{id}/edit','edit')->name('activite_investissement.edit');

    Route::post('/activite_investissement/{id}/update','update')->name('activite_investissement.update');
    Route::get('/activite_investissement/{id}/destroy','destroy')->name('activite_investissement.delete');
    Route::get('/activite_investissement/{id}/print','print')->name('activite_investissement.print');

    Route::post('/activite_investissement/{id}/depense_activite','depense_activite')->name('activite_investissement.depense_activite');
    Route::get('/activite_investissement/{id}/supprimer_depense','supprimer_depense')->name('activite_investissement.supprimer_depense');
    Route::get('/activite_investissement/{id}/annuler_livraison','annuler_livraison')->name('activite_investissement.annuler_livraison');
    Route::get('/activite_investissement/{id}/annuler_reglement','annuler_reglement')->name('activite_investissement.annuler_reglement');
    Route::get('/activite_investissement/reception_produit','reception_produit')->name('activite_investissement.reception_produit');
    Route::get('/activite_investissement/livraison_produit','livraison_produit')->name('activite_investissement.livraison_produit');

});

Route::middleware(['auth','initier'])->controller(DetailActiviteInvestissementController::class)->group(function(){

    Route::get('/detail_activite_investissement','index')->name('detail_activite_investissement');
    Route::get('/detail_activite_investissement/create','create')->name('detail_activite_investissement.create');
    Route::post('/detail_activite_investissement/store','store')->name('detail_activite_investissement.store');
    Route::get('/detail_activite_investissement/{id}/show','show')->name('detail_activite_investissement.show');
    Route::get('/detail_activite_investissement/{id}/edit','edit')->name('detail_activite_investissement.edit');
    Route::post('/detail_activite_investissement/{id}/update','update')->name('detail_activite_investissement.update');
    Route::get('/detail_activite_investissement/{id}/destroy','destroy')->name('detail_activite_investissement.delete');
    Route::get('/detail_activite_investissement/{id}/print','print')->name('detail_activite_investissement.print');


    Route::get('/detail_activite_investissement/{id}/supprimer_commande','supprimer_commande')->name('detail_activite_investissement.supprimer_commande');

    Route::get('/detail_activite_investissement/{id}/supprimer_reglement','supprimer_reglement')->name('detail_activite_investissement.supprimer_reglement');

});

Route::middleware(['auth','initier'])->controller(NatureOperationChargeController::class)->group(function(){

    Route::get('/nature_operation_charge','index')->name('nature_operation_charge');
    Route::get('/nature_operation_charge/create','create')->name('nature_operation_charge.create');
    Route::post('/nature_operation_charge/store','store')->name('nature_operation_charge.store');
    Route::get('/nature_operation_charge/{id}/show','show')->name('nature_operation_charge.show');
    Route::get('/nature_operation_charge/{id}/edit','edit')->name('nature_operation_charge.edit');
    Route::post('/nature_operation_charge/{id}/update','update')->name('nature_operation_charge.update');
    Route::get('/nature_operation_charge/{id}/destroy','destroy')->name('nature_operation_charge.delete');
    Route::get('/nature_operation_charge/{id}/print','print')->name('nature_operation_charge.print');

});

Route::middleware(['auth','initier'])->controller(SecteurDepenseController::class)->group(function(){

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
    Route::get('/operation/{id}/investisseur','operation_investisseur')->name('operation.compte');
    Route::get('/operation/{id}/dividende','operation_dividende')->name('operation.dividende');

    Route::get('/i_retrait/{id}/operation/valider','valider_operation_inv')->name('valider.operation_inv');
    Route::get('/d_retrait/{id}/operation/valider','valider_operation_div')->name('valider.operation_div');
});

Route::middleware(['auth','initier'])->controller(AchatVehiculeController::class)->group(function(){


    Route::get('/achat_vehicule','index')->name('achat_vehicule');
    Route::get('/achat_vehicule/{id}/detail','show')->name('achat_vehicule.show');
    Route::get('/achat_vehicule/{id}/edit','edit')->name('achat_vehicule.edit');
    Route::get('/achat_vehicule/{id}/print','print')->name('achat_vehicule.print');
    Route::post('/achat_vehicule/{id}/update','update')->name('achat_vehicule.update');
    Route::post('/achat_vehicule/fournisseur','fournisseur')->name('achat_vehicule.fournisseur');
    Route::post('/creer/achat_vehicule','store')->name('achat_vehicule.store');

});

Route::middleware(['auth','initier'])->controller(VenteVehiculeController::class)->group(function(){


    Route::get('/vente_vehicule','index')->name('vente_vehicule');
    Route::get('/vente_vehicule/{id}/detail','show')->name('vente_vehicule.show');
    Route::get('/vente_vehicule/{id}/valider','valider')->name('vente_vehicule.valider');
    Route::get('/vente_vehicule/{id}/annuler','annuler')->name('vente_vehicule.annuler');
    Route::get('/vente_vehicule/{id}/edit','edit')->name('vente_vehicule.edit');
    Route::get('/vente_vehicule/{id}/print','print')->name('vente_vehicule.print');
    Route::post('/vente_vehicule/{id}/update','update')->name('vente_vehicule.update');
    Route::post('/vente_vehicule/client','client')->name('vente_vehicule.client');
    Route::post('/vente_vehicule/chassis','chassis')->name('vente_vehicule.chassis');
    Route::post('/creer/vente_vehicule','store')->name('vente_vehicule.store');

});

Route::middleware(['auth','initier'])->controller(ActiviteVehiculeController::class)->group(function(){


    Route::get('/activite_vehicule','index')->name('activite_vehicule');
    Route::get('/activite_vehicule/encours','encours')->name('activite_vehicule.encours');
    Route::get('/activite_vehicule/fermer','fermeture')->name('activite_vehicule.fermer');
    Route::get('/activite_vehicule/terminer','terminer')->name('activite_vehicule.terminer');
    Route::get('/activite_vehicule/{id}/detail','show')->name('activite_vehicule.show');
    Route::get('/activite_vehicule/{id}/edit','edit')->name('activite_vehicule.edit');
    Route::get('/{id}/activite_vehicule/repartition','repartition')->name('activite_vehicule.repartition');
    Route::post('/activite_vehicule/repartie','repartie')->name('activite_vehicule.repartie');
    Route::get('/activite_vehicule/{id}/print','print')->name('activite_vehicule.print');
    Route::post('/activite_vehicule/{id}/update','update')->name('activite_vehicule.update');
    Route::get('/activite_vehicule/{id}/destroy','destroy')->name('activite_vehicule.delete');
    Route::get('/activite_vehicule/valider','valider')->name('activite_vehicule.valider');
    Route::post('/activite_vehicule/client','client')->name('activite_vehicule.client');
    Route::post('/activite_vehicule/chassis','chassis')->name('activite_vehicule.chassis');
    Route::post('/creer/activite_vehicule','store')->name('activite_vehicule.store');

});

Route::middleware(['auth','initier'])->controller(DetailActiviteVehiculeController::class)->group(function(){

    Route::get('/detail_activite_vehicule','index')->name('detail_activite_vehicule');
    Route::get('/detail_activite_vehicule/create','create')->name('detail_activite_vehicule.create');
    Route::post('/detail_activite_vehicule/store','store')->name('detail_activite_vehicule.store');
    Route::get('/detail_activite_vehicule/{id}/show','show')->name('detail_activite_vehicule.show');
    Route::get('/detail_activite_vehicule/{id}/edit','edit')->name('detail_activite_vehicule.edit');
    Route::post('/detail_activite_vehicule/{id}/update','update')->name('detail_activite_vehicule.update');
    Route::get('/detail_activite_vehicule/{id}/destroy','destroy')->name('detail_activite_vehicule.delete');
    Route::get('/detail_activite_vehicule/{id}/print','print')->name('detail_activite_vehicule.print');

});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| controller de hotel
|
*/
Route::middleware(['auth','initier'])->controller(TypeChambreController::class)->group(function(){

    Route::get('/type_chambre','index')->name('type_chambre');
    Route::post('/creer/type_chambre','store')->name('type_chambre.store');
    Route::get('/type_chambre/{id}/show','show')->name('type_chambre.show');
    Route::get('/type_chambre/{id}/edit','edit')->name('type_chambre.edit');
    Route::post('/type_chambre/{id}/update','update')->name('type_chambre.update');
    Route::get('/type_chambre/{id}/print','print')->name('type_chambre.print');

});

Route::middleware(['auth','initier'])->controller(TypeServiceController::class)->group(function(){

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
Route::middleware(['auth','initier'])->controller(EntrepotController::class)->group(function(){

    Route::get('/entrepot','index')->name('entrepot');
    Route::post('/creer/entrepot','store')->name('entrepot.store');
    Route::get('/entrepot/{id}/show','show')->name('entrepot.show');
    Route::get('/entrepot/{id}/edit','edit')->name('entrepot.edit');
    Route::post('/entrepot/{id}/update','update')->name('entrepot.update');
    Route::get('/entrepot/{id}/print','print')->name('entrepot.print');

});

Route::middleware(['auth','initier'])->controller(CommandeController::class)->group(function(){

    Route::get('/commande','index')->name('commande');
    Route::get('/creer/commande','create')->name('commande.create');
    Route::post('/creer/commande','store')->name('commande.store');
    Route::get('/commande/{id}/show','show')->name('commande.show');
    Route::get('/commande/{id}/edit','edit')->name('commande.edit');
    Route::post('/commande/select','select_produit')->name('produit_select.commande');
    Route::post('/commande/{id}/update','update')->name('commande.update');
    Route::get('/commande/{id}/delete','destroy')->name('commande.delete');
    Route::get('/commande/{id}/print','print')->name('commande.print');

});
Route::middleware(['auth','initier'])->controller(DetailCommandeController::class)->group(function(){

    Route::get('/detail_commande','index')->name('detail_commande');
    Route::post('/creer/detail_commande','create')->name('detail_commande.create');
    Route::post('/creer/detail_commande','store')->name('detail_commande.store');
    Route::get('/detail_commande/{id}/show','show')->name('detail_commande.show');
    Route::get('/detail_commande/{id}/edit','edit')->name('detail_commande.edit');
    Route::post('/detail_commande/{id}/update','update')->name('detail_commande.update');
    Route::get('/detail_commande/{id}/print','print')->name('detail_commande.print');
    Route::get('/detail_commande/{id}/delete','destroy')->name('detail_commande.delete');
    Route::post('/fournisseur/detail_commande','fournisseur_commande')->name('detail_commande_fournisseur.select');

});

Route::middleware(['auth','initier'])->controller(DevisController::class)->group(function(){

    Route::get('/devis','index')->name('devis');
    Route::get('/creer/devis','create')->name('devis.create');
    Route::post('/creer/devis','store')->name('devis.store');
    Route::get('/devis/{id}/show','show')->name('devis.show');
    Route::get('/devis/{id}/edit','edit')->name('devis.edit');
    Route::post('/devis/select','select_produit')->name('produit_select.devis');
    Route::post('/devis/{id}/update','update')->name('devis.update');
    Route::get('/devis/{id}/delete','destroy')->name('devis.delete');
    Route::post('/devis/{id}activite','activite_devis')->name('devis.activite');
    Route::get('/devis/{id}/print','print')->name('devis.print');

});

Route::middleware(['auth','initier'])->controller(DetailDevisController::class)->group(function(){

    Route::get('/detail_devis','index')->name('detail_devis');
    Route::post('/creer/detail_devis','store')->name('detail_devis.store');
    Route::get('/detail_devis/{id}/show','show')->name('detail_devis.show');
    Route::get('/detail_devis/{id}/edit','edit')->name('detail_devis.edit');
    Route::post('/detail_devis/{id}/update','update')->name('detail_devis.update');
    Route::get('/detail_devis/{id}/print','print')->name('detail_devis.print');
    Route::get('/detail_devis/{id}/delete','destroy')->name('detail_devis.delete');
    Route::post('/client/detail_devis','client_devis')->name('detail_devis_client.select');

});

Route::middleware(['auth','initier'])->controller(LivrerController::class)->group(function(){

    Route::get('/livrer','index')->name('livrer');
    Route::post('/creer/livrer','store')->name('livrer.store');
    Route::get('/livrer/{id}/show','show')->name('livrer.show');
    Route::get('/livrer/{id}/edit','edit')->name('livrer.edit');
    Route::post('/livrer/{id}/update','update')->name('livrer.update');
    Route::post('/livrer/{id}/delete','destroy')->name('livrer.delete');
    Route::get('/livrer/{id}/print','print')->name('livrer.print');

});

Route::middleware(['auth','initier'])->controller(DetailLivrerController::class)->group(function(){

    Route::get('/detail_livrer','index')->name('detail_livrer');
    Route::post('/creer/detail_livrer','store')->name('detail_livrer.store');
    Route::get('/detail_livrer/{id}/show','show')->name('detail_livrer.show');
    Route::get('/detail_livrer/{id}/edit','edit')->name('detail_livrer.edit');
    Route::post('/detail_livrer/{id}/update','update')->name('detail_livrer.update');
    Route::get('/detail_livrer/{id}/print','print')->name('detail_livrer.print');

});

Route::middleware(['auth','initier'])->controller(FactureController::class)->group(function(){

    Route::get('/facture','index')->name('facture');
    Route::post('/creer/facture','store')->name('facture.store');
    Route::get('/facture/{id}/show','show')->name('facture.show');
    Route::get('/facture/{id}/edit','edit')->name('facture.edit');
    Route::post('/facture/select','select_produit')->name('produit_select.facture');
    Route::post('/facture/{id}/update','update')->name('facture.update');
    Route::get('/facture/{id}/print','print')->name('facture.print');

});

Route::middleware(['auth','initier'])->controller(DetailFactureController::class)->group(function(){

    Route::get('/detail_facture','index')->name('detail_facture');
    Route::post('/creer/detail_facture','store')->name('detail_facture.store');
    Route::get('/detail_facture/{id}/show','show')->name('detail_facture.show');
    Route::get('/detail_facture/{id}/edit','edit')->name('detail_facture.edit');
    Route::post('/detail_facture/{id}/update','update')->name('detail_facture.update');
    Route::get('/detail_facture/{id}/print','print')->name('detail_facture.print');
    Route::get('/detail_facture/{id}/delete','destroy')->name('detail_facture.delete');
    Route::post('/entrepot/detail_facture','facture_entrepot')->name('detail_facture_entrepot.select');

});

Route::middleware(['auth','initier'])->controller(InventaireStockController::class)->group(function(){

    Route::get('/inventaire_stock','index')->name('inventaire_stock');
    Route::post('/creer/inventaire_stock','store')->name('inventaire_stock.store');
    Route::get('/inventaire_stock/{id}/show','show')->name('inventaire_stock.show');
    Route::get('/inventaire_stock/{id}/edit','edit')->name('inventaire_stock.edit');
    Route::post('/inventaire_stock/{id}/update','update')->name('inventaire_stock.update');
    Route::get('/inventaire_stock/{id}/print','print')->name('inventaire_stock.print');

});

Route::middleware(['auth','initier'])->controller(ReglementFactureController::class)->group(function(){

    Route::get('/reglement/facture','index')->name('reglement.facture');
    Route::post('/reglement/store','store')->name('reglement.store');
    Route::get('/reglement/comptoir','comptoir')->name('reglement.comptoir');
    Route::post('/reglement/client','numero_client')->name('reglement.numero_client');
    Route::get('/reglement/{id}/paiement','paiement_facture')->name('reglement.paiement');
    Route::get('/reglement/{id}/paiement/print','print')->name('reglement.paiement.print');

});



/**
 * GESTION DES DETENUE
 */

 Route::middleware(['auth','initier'])->controller(DetenuController::class)->group(function(){

    Route::get('/detention/detenu/index','index')->name('index.detenu');
    Route::get('/detention/detenu/create','create')->name('create.detenu');
    Route::post('/detention/store','store')->name('store.detenu');
    Route::get('/detention/detenu/{id}','edit')->name('edit.detenu');

});

/**
 * CABINET ASSURANCE
 */

 Route::middleware(['auth','initier'])->prefix('assurance')->controller(GroupeController::class)->group(function(){
    Route::get('/groupe/index','index')->name('index.groupe');
});

Route::middleware(['auth','initier'])->prefix('assurance')->controller(ZoneController::class)->group(function(){
    Route::get('/zone/index','index')->name('index.zone');

});

Route::middleware(['auth','initier'])->prefix('assurance')->controller(ClasseController::class)->group(function(){
    Route::get('/classe/index','index')->name('index.classe');

});
Route::middleware(['auth','initier'])->prefix('assurance')->controller(PuissanceController::class)->group(function(){
    Route::get('/puissance/index','index')->name('index.puissance');

});
Route::middleware(['auth','initier'])->prefix('assurance')->controller(EnergieController::class)->group(function(){
    Route::get('/energie/index','index')->name('index.energie');

});
Route::middleware(['auth','initier'])->prefix('assurance')->controller(UsageController::class)->group(function(){
    Route::get('/usage/index','index')->name('index.usage');

});
Route::middleware(['auth','initier'])->prefix('assurance')->controller(DureeController::class)->group(function(){
    Route::get('/duree/index','index')->name('index.duree');

});
Route::middleware(['auth','initier'])->prefix('assurance')->controller(GenreController::class)->group(function(){
    Route::get('/genre/index','index')->name('index.genre');

});
Route::middleware(['auth','initier'])->prefix('assurance')->controller(CategorieController::class)->group(function(){
    Route::get('/categorie/index','index')->name('index.categorie');

});
Route::middleware(['auth','initier'])->prefix('assurance')->controller(MarqueController::class)->group(function(){
    Route::get('/marque/index','index')->name('index.marque');

});

Route::middleware(['auth','initier'])->prefix('assurance')->controller(PrimeNetController::class)->group(function(){
    Route::get('/prime_net/index','index')->name('index.prime_net');

});
/**
 * GESTION CABINET MEDICAL
 */
 Route::group([
    "middleware"=>['auth','initier'],
    "as"=>'ad.'
],function(){
        Route::group([
            'prefixe'=>'cabinet_medical',
            'as'=>'sante.'
        ],function(){

            Route::get('ad/sante/patient',Patient::class)->name('index.patient');
            Route::get('ad/sante/patient/{id}/edit',PatientEdit::class)->name('edit.patient');
            Route::get('ad/sante/patient/{id}/dossier',PatientDossier::class)->name('dossier.patient');

            Route::get('ad/sante/medecin',Medecin::class)->name('index.medecin');
            Route::get('ad/sante/medecin/user',MedecinUser::class)->name('medecin.user');
            Route::get('ad/sante/medecin/{id}/edit',MedecinEdit::class)->name('edit.medecin');
            Route::get('ad/sante/{id}/dossier/medecin',MedecinDossier::class)->name('dossier.medecin');
            Route::get('ad/sante/planification/medecin',PlanificationMedecin::class)->name('index.planification.medecin');
            Route::get('ad/sante/specialite/medicale',SpecialiteMedicale::class)->name('specialite.medicale');
            Route::get('ad/sante/edit/specialite/{id}/medicale',SpecialiteMedicale::class)->name('edit.specialite.medicale');
            Route::get('ad/sante/categorie/medicale',CategorieMedicale::class)->name('categorie.medicale');
            Route::get('ad/sante/categorie/{id}/edit/medicale',EditCategorieMedicale::class)->name('edit.categorie.medicale');

            Route::get('ad/sante/tarif/consultation',TarifConsultation::class,)->name('tarif.consultation');
            Route::get('ad/sante/edit/tarif/consultation/{id}/',EditTarifConsultation::class)->name('edit.tarif.consultation');
            Route::get('ad/sante/type/consultation',TypeConsultation::class)->name('type.consultation');
            Route::get('ad/sante/edit/type/consultation',EditTypeConcultation::class)->name('edit.type.consultation');
            Route::get('ad/sante/consultation',Consultation::class)->name('index.consultation');

            Route::get('ad/sante/consultation/rendez-vous',RendezVousConsultation::class)->name('rendez-vous.consultation');
            Route::get('ad/sante/consultation/rendez-vous/{id}/Dossier',DossierRendezVousConsultation::class)->name('dossier.rendez-vous.consultation');
            Route::get('ad/sante/consultation/{id}/Dossier',DossierConsultation::class)->name('dossier.consultation');
            Route::get('ad/sante/consultation/facturation',FacturationConsultation::class)->name('facturation.consultation');
            Route::get('ad/sante/consultation/{id}/Recu',RecuConsultation::class)->name('recu.consultation');
            Route::get('ad/sante/consultation/{id}/traitement',TraitementConsultation::class)->name('traitement.consultation');
            Route::get('ad/sante/consultation/{id}/resultat',ResultatConsultation::class)->name('resultat.consultation');

            Route::get('ad/sante/maison/assurance/medicale',MaisonAssurance::class)->name('maison.assurance.medicale');
            Route::get('ad/sante/maison/assurance/{id}/edit',MaisonAssuranceEdit::class)->name('maison.assurance.edit');

            Route::get('ad/sante/contrat/assurance/medicale',ContratAssurance::class)->name('contrat.assurance.medicale');
            Route::get('ad/sante/prise_en_charge/assurance',PriseEnCharge::class)->name('prise_en_charge.assurance.consultation');

            Route::get('ad/sante/medicament',Medicament::class)->name('medicament');

            Route::get('ad/sante/type/examen',TypeExamen::class)->name('type.examen');
            Route::get('ad/sante/examen/medical',Examen::class)->name('examen.medical');


        });
       //
    });








require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteControllers\HomeController as SiteHomeController;
use App\Http\Controllers\SiteControllers\ContatoController as ContatoSiteController;
use App\Http\Controllers\SiteControllers\SobreController as SobreSiteController;
use App\Http\Controllers\SiteControllers\PortfolioController;
use App\Http\Controllers\CmsControllers\HomeController;
use App\Http\Controllers\CmsControllers\UsuariosController;
use App\Http\Controllers\CmsControllers\ProjetosController;
use App\Http\Controllers\CmsControllers\GaleriasController;
use App\Http\Controllers\CmsControllers\DestaqueController;
use App\Http\Controllers\CmsControllers\SobreController;
use App\Http\Controllers\CmsControllers\ContatoController;

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

Route::get('/', [SiteHomeController::class, 'index'])->name('home');
Route::get('/film', [PortfolioController::class, 'indexFilm'])->name('portfolio.film');
Route::get('/photography', [PortfolioController::class, 'indexPhotography'])->name('portfolio.photography');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'single'])->name('portfolio.single');
Route::get('/sobre', [SobreSiteController::class, 'index'])->name('sobre');
Route::get('/contato', [ContatoSiteController::class, 'index'])->name('contato');
Route::post('/contato/send-message', [ContatoSiteController::class, 'sendMessage'])->name('sendmsg');



// Rotas CMS ################################################################
// --------------------------------------------------------------------------
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function ()
    {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        // USUÁRIOS
        Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
        Route::get('/usuarios/{id}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
        Route::post('/usuarios/{id}/update', [UsuariosController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/{id}/delete', [UsuariosController::class, 'delete'])->name('usuarios.delete');

        // PROJETOS
        Route::get('/projetos', [ProjetosController::class, 'index'])->name('projetos.index');
        Route::get('/projetos/create', [ProjetosController::class , 'create'])->name('projetos.create');
        Route::post('/projetos/store', [ProjetosController::class , 'store'])->name('projetos.store');
        Route::get('/projetos/{id}/edit', [ProjetosController::class , 'edit'])->name('projetos.edit');
        Route::put('/projetos/{id}/update', [ProjetosController::class , 'update'])->name('projetos.update');
        Route::delete('/projetos/{id}/delete', [ProjetosController::class , 'delete'])->name('projetos.delete');

        // GALERIA
        Route::get('/galerias', [GaleriasController::class, 'index'])->name('galerias.index');
        Route::get('/galerias/create', [GaleriasController::class, 'create'])->name('galerias.create');
        Route::post('/galerias/store', [GaleriasController::class, 'store'])->name('galerias.store');
        Route::get('/galerias/{id}/edit', [GaleriasController::class, 'edit'])->name('galerias.edit');
        Route::put('/galerias/{id}/update', [GaleriasController::class, 'update'])->name('galerias.update');
        Route::delete('/galerias/{id}/delete', [GaleriasController::class, 'delete'])->name('galerias.delete');
        // -- ADICIONAR/REMOVER FOTOS DA GALERIA
        Route::post('/galerias/{id}/add', [GaleriasController::class, 'add'])->name('galerias.add');
        Route::get('/galerias/{id}/remove/{id_imagem}', [GaleriasController::class, 'remove'])->name('galerias.remove');

        // DESTAQUES
        Route::get('/categorias-destaques', [DestaqueController::class, 'indexCategoria'])->name('destaques.indexCategoria');
        Route::get('/destaques/create', [DestaqueController::class , 'create'])->name('destaques.create');
        Route::get('/destaques/{id}', [DestaqueController::class, 'index'])->name('destaques.index');
        Route::post('/destaques/store', [DestaqueController::class , 'store'])->name('destaques.store');
        Route::get('/destaques/{id}/edit', [DestaqueController::class , 'edit'])->name('destaques.edit');
        Route::put('/destaques/{id}/update', [DestaqueController::class , 'update'])->name('destaques.update');
        Route::delete('/destaques/{id}/delete', [DestaqueController::class , 'delete'])->name('destaques.delete');

        // SOBRE
        Route::get('/sobre', [SobreController::class, 'index'])->name('sobre.index');
        Route::put('/sobre/{id}/update', [SobreController::class , 'update'])->name('sobre.update');

        // CONTATO
        Route::get('/contatos', [ContatoController::class, 'index'])->name('contatos.index');
        Route::get('/contatos/{id}', [ContatoController::class, 'edit'])->name('contatos.edit');
        Route::delete('/contatos/deleteAll', [ContatoController::class, 'deleteAll'])->name('contatos.deleteAll');
        Route::delete('/contatos/{id}', [ContatoController::class, 'delete'])->name('contatos.delete');

    });
});

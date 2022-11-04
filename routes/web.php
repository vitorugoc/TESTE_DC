<?php
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AutenticacaoMiddleware;

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


Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/', [LoginController::class, 'autenticar'])->name('login.index');

Route::get('/sair', [LoginController::class, 'sair'])->name('login.sair');

Route::get('/registrar', [LoginController::class, 'registrar'])->name('registrar.index');
Route::post('/registrar', [LoginController::class, 'adicionar'])->name('registrar.index');


Route::middleware('autenticacao')->prefix('')->group(function(){
    Route::get('/vendedor', [VendedorController::class, 'index'])->name('vendedor.index');
    Route::post('/vendedor/adicionar', [VendedorController::class, 'adicionar'])->name('vendedor.adicionar');
    Route::get('/vendedor/adicionar', [VendedorController::class, 'adicionar'])->name('vendedor.adicionar');
    Route::get('/vendedor/listar', [VendedorController::class, 'listar'])->name('vendedor.listar');
    Route::post('/vendedor/listar', [VendedorController::class, 'listar'])->name('vendedor.listar');
    Route::get('/vendedor/editar/{id}/{msg?}', [VendedorController::class, 'editar'])->name('vendedor.editar');
    Route::get('/vendedor/excluir/{id}', [VendedorController::class, 'excluir'])->name('vendedor.excluir');
});



Route::middleware('autenticacao')->prefix('')->group(function(){
    Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
    Route::post('/cliente/adicionar', [ClienteController::class, 'adicionar'])->name('cliente.adicionar');
    Route::get('/cliente/adicionar', [ClienteController::class, 'adicionar'])->name('cliente.adicionar');
    Route::get('/cliente/listar', [ClienteController::class, 'listar'])->name('cliente.listar');
    Route::post('/cliente/listar', [ClienteController::class, 'listar'])->name('cliente.listar');
    Route::get('/cliente/editar/{id}/{msg?}', [ClienteController::class, 'editar'])->name('cliente.editar');
    Route::get('/cliente/excluir/{id}', [ClienteController::class, 'excluir'])->name('cliente.excluir');
});


Route::middleware('autenticacao')->prefix('')->group(function(){
    Route::get('/venda', [VendaController::class, 'index'])->name('venda.index');
    Route::post('/venda/adicionar', [VendaController::class, 'adicionar'])->name('venda.adicionar');
    Route::get('/venda/adicionar', [VendaController::class, 'adicionar'])->name('venda.adicionar');
    Route::get('/venda/listar', [VendaController::class, 'listar'])->name('venda.listar');
    Route::post('/venda/listar', [VendaController::class, 'listar'])->name('venda.listar');
    Route::get('/venda/editar/{id}/{msg?}', [VendaController::class, 'editar'])->name('venda.editar');
    Route::get('/venda/excluir/{id}', [VendaController::class, 'excluir'])->name('venda.excluir');
});

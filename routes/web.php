<?php
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

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



Route::get('/', [VendedorController::class, 'index'])->name('vendedor.index');
Route::post('/vendedor/adicionar', [VendedorController::class, 'adicionar'])->name('vendedor.adicionar');
Route::get('/vendedor/adicionar', [VendedorController::class, 'adicionar'])->name('vendedor.adicionar');
Route::get('/vendedor/listar', [VendedorController::class, 'listar'])->name('vendedor.listar');
Route::post('/vendedor/listar', [VendedorController::class, 'listar'])->name('vendedor.listar');
Route::get('/vendedor/editar/{id}/{msg?}', [VendedorController::class, 'editar'])->name('vendedor.editar');
Route::get('/vendedor/excluir/{id}', [VendedorController::class, 'excluir'])->name('vendedor.excluir');

Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
Route::post('/cliente/adicionar', [ClienteController::class, 'adicionar'])->name('cliente.adicionar');
Route::get('/cliente/adicionar', [ClienteController::class, 'adicionar'])->name('cliente.adicionar');
Route::get('/cliente/listar', [ClienteController::class, 'listar'])->name('cliente.listar');
Route::post('/cliente/listar', [ClienteController::class, 'listar'])->name('cliente.listar');
Route::get('/cliente/editar/{id}/{msg?}', [ClienteController::class, 'editar'])->name('cliente.editar');
Route::get('/cliente/excluir/{id}', [ClienteController::class, 'excluir'])->name('cliente.excluir');
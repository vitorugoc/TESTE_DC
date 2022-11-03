<?php

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

use App\Http\Controllers\VendedorController;

Route::get('/', [VendedorController::class, 'index'])->name('vendedor.index');
Route::post('/vendedor/adicionar', [VendedorController::class, 'adicionar'])->name('vendedor.adicionar');
Route::get('/vendedor/adicionar', [VendedorController::class, 'adicionar'])->name('vendedor.adicionar');
Route::get('/vendedor/listar', [VendedorController::class, 'listar'])->name('vendedor.listar');
Route::post('/vendedor/listar', [VendedorController::class, 'listar'])->name('vendedor.listar');
Route::get('/vendedor/editar/{id}/{msg?}', [VendedorController::class, 'editar'])->name('vendedor.editar');

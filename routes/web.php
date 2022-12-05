<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create', [App\Http\Controllers\PesanController::class, 'create'])->name('buat');
Route::post('/simpan', [App\Http\Controllers\PesanController::class, 'batik'])->name('simpan');
Route::get('/edit/{id}', [App\Http\Controllers\PesanController::class, 'edit'])->name('edit');

Route::post('edit/{id}', [App\Http\Controllers\PesanController::class, 'update'])->name('update');
Route::post('delete/{id}', [App\Http\Controllers\PesanController::class,  'delete'])->name('delete');
Route::get('pesan/{id}', [App\Http\Controllers\PesanController::class, 'index'])->name('pesan');
Route::post('order/{id}', [App\Http\Controllers\PesanController::class, 'order'])->name('order');
Route::get('/checkout', [App\Http\Controllers\PesanController::class, 'checkout'])->name('checkout');

Route::delete('hapus/{id}', [App\Http\Controllers\PesanController::class, 'hapus'])->name('hapus');
Route::post('bayar', [App\Http\Controllers\HistoryController::class, 'checkout'])->name('bayar');
Route::get('detail', [App\Http\Controllers\HistoryController::class, 'detail'])->name('detail');
Route::post('ubah/{id}', [App\Http\Controllers\HistoryController::class, 'ubah'])->name('ubah');

Route::get('cari', [App\Http\Controllers\PesanController::class, 'cari'])->name('cari');

Route::post('soft/{id}', [App\Http\Controllers\HomeController::class, 'soft'])->name('soft');
Route::get('restore/{id}', [App\Http\Controllers\HomeController::class, 'restore'])->name('restore');
Route::get('/soft', [App\Http\Controllers\HomeController::class, 'softIndex'])->name('softDelete');

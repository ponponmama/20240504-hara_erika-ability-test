<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
Route::get('/admin/reset_search', [AdminController::class, 'resetSearch'])->name('admin.reset_search');
Route::get('/admin/contacts/export_csv', [AdminController::class, 'exportCsv'])->name('admin.contacts.export_csv');

Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

Route::get('/', [ContactController::class,'index'])->name('contact.index');
Route::post('/contact/edit', [ContactController::class,'edit'])->name('contact.edit');
Route::post('/contact/submit', [ContactController::class,'submit'])->name('contact.submit');
Route::post('/contact/confirm', [ContactController::class,'confirm'])->name('contact.confirm');
Route::get('thanks',[ContactController::class,'thanks'])->name('thanks');

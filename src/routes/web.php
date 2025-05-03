<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

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

// ログインと登録のルート
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (LoginRequest $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('admin');
    }
    return back()->withErrors([
        'email' => 'メールアドレスまたはパスワードが正しくありません。',
    ]);
})->name('login.post');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', function (RegisterRequest $request) {
    $user = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    Auth::login($user);
    return redirect()->route('admin.index');
})->name('register.post');

// ログアウトのルート
Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('/admin/reset_search', [AdminController::class, 'resetSearch'])->name('admin.reset_search');
    Route::get('/admin/contacts/export_csv', [AdminController::class, 'exportCsv'])->name('admin.contacts.export_csv');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

Route::get('/', [ContactController::class,'index'])->name('contact.index');
Route::post('/contact/edit', [ContactController::class,'edit'])->name('contact.edit');
Route::post('/contact/submit', [ContactController::class,'submit'])->name('contact.submit');
Route::post('/contact/confirm', [ContactController::class,'confirm'])->name('contact.confirm');
Route::get('thanks',[ContactController::class,'thanks'])->name('thanks');
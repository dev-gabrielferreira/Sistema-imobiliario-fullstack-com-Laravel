<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BairroController;
use App\Http\Controllers\FinalidadeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImovelController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TipoController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, 'index'])->name('home');
Route::get("/search/{bairro}", [HomeController::class, 'buscar'])->name('home.buscar');
Route::get('/imoveis/{titulo}/{id}', [PublicController::class, 'show']);
Route::get('/imoveis', [PublicController::class, 'index'])->name('index');
Route::get('/anunciar', [PublicController::class, 'showMailForm'])->name('anunciar.show');
Route::post('/anunciar', [PublicController::class, 'sendMail'])->name('anunciar.send');
Route::get('/sobre', [PublicController::class, 'about'])->name('sobre');
Route::get("/admin/perfil/senha/reset", [PerfilController::class, "showResetPasswordForm"])->name("perfil.reset");
Route::post("/admin/perfil/senha/reset", [PerfilController::class, "resetPassword"])->name("perfil.reset");

Route::controller(AuthController::class)->group(function (){
    Route::get('/admin/login', 'showLoginForm')->name('login');
    Route::post('/admin/login', 'login')->name('auth.login');
});

Route::middleware('auth')->group(function (){
    Route::post("/logout", [AuthController::class, "logout"])->name("logout");
    Route::get("/admin/dashboard", [AdminController::class, "dashboard"])->name("admin.dashboard");
    Route::controller(FinalidadeController::class)->group(function (){
        Route::get('/admin/finalidades', 'index')->name('finalidades.index');
        Route::get('/admin/finalidades/criar', 'create')->name('finalidades.create');
        Route::post('/admin/finalidades/criar', 'store')->name('finalidades.store');
        Route::post('/admin/finalidades/{id}/editar', 'update')->name('finalidades.update');
        Route::get('/admin/finalidades/{id}', 'show')->name('finalidades.show');
        Route::delete('/admin/finalidades/{id}/apagar', 'destroy')->name('finalidades.destroy');
    });
    
    Route::controller(TipoController::class)->group(function (){
        Route::get('/admin/tipos', 'index')->name('tipos.index');
        Route::get('/admin/tipos/criar', 'create')->name('tipos.create');
        Route::post('/admin/tipos/criar', 'store')->name('tipos.store');
        Route::post('/admin/tipos/{id}/editar', 'update')->name('tipos.update');
        Route::get('/admin/tipos/{id}', 'show')->name('tipos.show');
        Route::delete('/admin/tipos/{id}/apagar', 'destroy')->name('tipos.destroy');
    });
    
    Route::controller(BairroController::class)->group(function (){
        Route::get('/admin/bairros', 'index')->name('bairros.index');
        Route::get('/admin/bairros/criar', 'create')->name('bairros.create');
        Route::post('/admin/bairros/criar', 'store')->name('bairros.store');
        Route::post('/admin/bairros/{id}/editar', 'update')->name('bairros.update');
        Route::get('/admin/bairros/{id}', 'show')->name('bairros.show');
        Route::delete('/admin/bairros/{id}/apagar', 'destroy')->name('bairros.destroy');
    });
    
    Route::controller(ImovelController::class)->group(function (){
        Route::get('/admin/imoveis', 'index')->name('imoveis.index');
        Route::get('/admin/imoveis/criar', 'create')->name('imoveis.create');
        Route::post('/admin/imoveis/criar', 'store')->name('imoveis.store');
        Route::put('/admin/imoveis/{id}/editar', 'update')->name('imoveis.update');
        Route::get('/admin/imoveis/{id}', 'show')->name('imoveis.show');
        Route::delete('/admin/imoveis/{id}/apagar', 'destroy')->name('imoveis.destroy');
    });

    Route::controller(AuthController::class)->group(function() {
        Route::post("/admin/logout", "logout")->name("admin.logout");
        Route::post("/admin/registrar", "register")->name("admin.register");
    });

    Route::get("/admin/perfil", [PerfilController::class, "index"])->name("perfil.index");
    Route::post("/admin/perfil", [PerfilController::class, "update"])->name("perfil.update");
    Route::post("/admin/perfil/senha", [PerfilController::class, "updatePassword"])->name("perfil.password");
    

});

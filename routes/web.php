<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourrierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('courrier.index');
    } else {
        return redirect()->route('loginform');
    }
});
Route::middleware(['auth'])->group(function () {
    Route::get('/courrier', [CourrierController::class, 'index'])->name('courrier.index');
    Route::get('/courrier/create', [CourrierController::class, 'create'])->name('courrier.create');
    Route::get('/courrier/corbeille', [CourrierController::class, 'corbeille'])->name('courrier.corbeille');
    Route::post('/courrier', [CourrierController::class, 'store'])->name('courrier.store');
    Route::get('/courrier/{courrier}/edit', [CourrierController::class, 'edit'])->name('courrier.edit');
    Route::put('/courrier/{courrier}', [CourrierController::class, 'update'])->name('courrier.update');
    Route::delete('/courrier/{courrier}', [CourrierController::class, 'destroy'])->name('courrier.destroy');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginform');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

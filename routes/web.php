<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RecordController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

//residents
Route::resource('/residents', ResidentController::class);
Route::get('/residents/{id}', [ResidentController::class, 'destroy'])->name('residents.destroy');
Route::get('/residents', [ResidentController::class, 'index'])->name('residents.index');
Route::get('/residents/{id}/edit', [ResidentController::class, 'edit'])->name('residents.edit');
Route::put('/residents/{id}', [ResidentController::class, 'update'])->name('residents.update');

  //medicines
 Route::resource('medicines', MedicineController::class);
 Route::get('/medicines/{id}', [MedicineController::class, 'destroy'])->name('medicines.destroy');
 Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');



Route::get('/patient', [PatientController::class, 'index'])->name('patients.index'); // Display patient statistics and add new patient form
Route::get('/create', [PatientController::class, 'create'])->name('patients.create'); // Add new patient form
Route::post('/store', [PatientController::class, 'store'])->name('patients.store'); // Save new patient
Route::get('/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit'); // Edit patient details
Route::put('/{patient}', [PatientController::class, 'update'])->name('patients.update'); // Update patient

Route::resource('patients', PatientController::class);
Route::patch('/patients/{id}/update-status', [PatientController::class, 'updateStatus'])->name('patients.updateStatus');
Route::resource('records', RecordController::class);



// routes/web.php

use App\Http\Controllers\Auth\LoginController;

Auth::routes();

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
// routes/web.php

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('home'); // Change this to your protected route
    });
});

// routes/web.php

use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

use App\Http\Controllers\Auth\RegisterController;

use Illuminate\Support\Facades\Auth;

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Redirect all users to the login page if they are not logged in
Route::get('/', function () {
    if (auth()->check()) {
        return view('dashboard'); // Or your homepage view
    }
    return redirect()->route('login');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // other authenticated routes...
});

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Middleware\RedirectIfNotAuthenticated;

// Apply middleware to specific routes
Route::middleware([RedirectIfNotAuthenticated::class])->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
});











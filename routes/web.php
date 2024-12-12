<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::get('/dashboard', function () {

    $users = User::with('student')->latest()->paginate(20);
    return view('dashboard', [
        'users' => $users
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/students/show/{student}', [StudentController::class, 'show'])->name('student.show');
    Route::patch('/students/{student}', [StudentController::class, 'update'])->name('student.update')->can('update', User::class);
    Route::get('/students/edit/{student}', [StudentController::class, 'edit'])->name('student.edit')->can('update', User::class);
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('student.destroy')->can('update', User::class);
});

require __DIR__.'/auth.php';

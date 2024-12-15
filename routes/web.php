<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\RetroListController;
use App\Http\Controllers\Admin\RetrohotelController;

Route::view('/', 'home')->name('home');
Route::view('/team', 'team')->name('team');
Route::get('/retroliste', [RetroListController::class, 'index'])->name('retroliste');

Route::resource('admin/retrohotels', RetrohotelController::class)->names('admin.retrohotels');
Route::resource('admin/team_members', \App\Http\Controllers\Admin\TeamMemberController::class)->names('admin.team_members');

use App\Models\TeamMember;

Route::get('/team', function() {
    $members = TeamMember::all();
    return view('team', compact('members'));
})->name('team');

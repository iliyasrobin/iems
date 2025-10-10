<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', App\Livewire\Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

 Route::get('equipment', App\Livewire\EquipmentList::class)
    ->middleware(['auth', 'verified'])
    ->name('equipment');

 Route::get('departments', App\Livewire\Departments::class)
    ->middleware(['auth', 'verified'])
    ->name('departments');
    
 Route::get('ip-addresses', App\Livewire\IpAddressList::class)
    ->middleware(['auth', 'verified'])
    ->name('ip-addresses');

Route::get('gate-passes', App\Livewire\GatePassList::class)
    ->middleware(['auth', 'verified'])
    ->name('gate-passes');

Route::get('admin/gate-passes', App\Livewire\Admin\GatePassManagement::class)
    ->middleware(['auth', 'verified', \App\Http\Middleware\AdminMiddleware::class])
    ->name('admin.gate-passes');
    
Route::get('requisitions', App\Livewire\RequisitionList::class)
    ->middleware(['auth', 'verified'])
    ->name('requisitions');

Route::get('admin/requisitions', App\Livewire\Admin\RequisitionManagement::class)
    ->middleware(['auth', 'verified', \App\Http\Middleware\AdminMiddleware::class])
    ->name('admin.requisitions');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';

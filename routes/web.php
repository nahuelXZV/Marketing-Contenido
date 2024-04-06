<?php

use App\Livewire\System\Dashboard\Home;
use App\Livewire\System\Role\CreateRole;
use App\Livewire\System\Role\EditRole;
use App\Livewire\System\Role\ListRole;
use App\Livewire\System\User\CreateUser;
use App\Livewire\System\User\EditUser;
use App\Livewire\System\User\ListUser;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', Home::class)->name('dashboard');
    Route::get('/dashboard', Home::class);

    // user routes
    Route::group(
        ['prefix' => 'user', 'middleware' => ['can:usuario.index']],
        function () {
            Route::get('/list', ListUser::class)->name('user.list');
            Route::get('/new', CreateUser::class)->name('user.new');
            Route::get('/edit/{user}', EditUser::class)->name('user.edit');
        }
    );

    // role routes
    Route::group(['prefix' => 'role', 'middleware' => ['can:roles.index']], function () {
        Route::get('/list', ListRole::class)->name('role.list');
        Route::get('/new', CreateRole::class)->name('role.new');
        Route::get('/edit/{role}', EditRole::class)->name('role.edit');
    });
});

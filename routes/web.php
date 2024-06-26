<?php

use App\Http\Controllers\ImagenController;
use App\Livewire\Campaign\Campaign\CreateCampaign;
use App\Livewire\Campaign\Campaign\EditCampaign;
use App\Livewire\Campaign\Campaign\ListCampaign;
use App\Livewire\Campaign\Campaign\ShowCampaign;
use App\Livewire\Campaign\Publication\Components\EditImage;
use App\Livewire\Campaign\Publication\CreatePublication;
use App\Livewire\Campaign\Publication\EditPublication;
use App\Livewire\Campaign\Publication\ShowPublication;
use App\Livewire\Customer\Customer\CreateCustomer;
use App\Livewire\Customer\Customer\EditCustomer;
use App\Livewire\Customer\Customer\ListCustomer;
use App\Livewire\Customer\Customer\ShowCustomer;
use App\Livewire\Customer\Contract\CreateContract;
use App\Livewire\Customer\Contract\EditContract;
use App\Livewire\Customer\Contract\ShowContract;
use App\Livewire\System\Company\EditCompany;
use App\Livewire\System\Dashboard\Home;
use App\Livewire\System\Role\CreateRole;
use App\Livewire\System\Role\EditRole;
use App\Livewire\System\Role\ListRole;
use App\Livewire\System\User\CreateUser;
use App\Livewire\System\User\EditUser;
use App\Livewire\System\User\ListUser;
use App\Report\CampaignReport;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get('/policy', function () {
    return view('policy');
})->name('policy');
Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', Home::class)->name('dashboard');
    Route::get('/dashboard', Home::class);


    // user routes
    Route::group(
        ['prefix' => 'user', 'middleware' => ['can:user']],
        function () {
            Route::get('/list', ListUser::class)->name('user.list');
            Route::get('/new', CreateUser::class)->name('user.new');
            Route::get('/edit/{user}', EditUser::class)->name('user.edit');
        }
    );

    // role routes
    Route::group(['prefix' => 'role', 'middleware' => ['can:role']], function () {
        Route::get('/list', ListRole::class)->name('role.list');
        Route::get('/new', CreateRole::class)->name('role.new');
        Route::get('/edit/{role}', EditRole::class)->name('role.edit');
    });

    // company routes
    Route::group(['prefix' => 'company', 'middleware' => ['can:company']], function () {
        Route::get('/edit/{company}', EditCompany::class)->name('company.edit');
    });

    // customer routes
    Route::group(['prefix' => 'customer', 'middleware' => ['can:customer']], function () {
        Route::get('/list', ListCustomer::class)->name('customer.list');
        Route::get('/new', CreateCustomer::class)->name('customer.new');
        Route::get('/edit/{customer}', EditCustomer::class)->name('customer.edit');
        Route::get('/show/{customer}', ShowCustomer::class)->name('customer.show');
    });

    // contract routes
    Route::group(['prefix' => 'customer/contract', 'middleware' => ['can:contract']], function () {
        Route::get('/new/{customer}', CreateContract::class)->name('contract.new');
        Route::get('/edit/{contract}', EditContract::class)->name('contract.edit');
        Route::get('/show/{contract}', ShowContract::class)->name('contract.show');
    });

    // campaign routes
    Route::group(['prefix' => 'campaign'], function () {
        Route::get('/list', ListCampaign::class)->name('campaign.list');
        Route::get('/new', CreateCampaign::class)->name('campaign.new');
        Route::get('/edit/{campaign}', EditCampaign::class)->name('campaign.edit');
        Route::get('/show/{campaign}', ShowCampaign::class)->name('campaign.show');
        Route::get('/pdf/{campaign}', function ($campaign) {
            $pdf = new CampaignReport();
            return $pdf->generate($campaign);
        })->name('campaign.pdf');
    });

    // publication routes
    Route::group(['prefix' => 'campaign/publication'], function () {
        Route::get('/new/{campaign}', CreatePublication::class)->name('publication.new');
        Route::get('/edit/{publication}', EditPublication::class)->name('publication.edit');
        Route::get('/show/{publication}', ShowPublication::class)->name('publication.show');
        Route::get('/image/{resource}', EditImage::class)->name('publication.image');
    });

    // download image route
    Route::get('campaign/publication/image/download/{resource}', [ImagenController::class, 'download'])->name('resource.download');
});

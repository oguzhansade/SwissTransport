<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});
// Route::middleware(['guest'])->group(function () {
        Route::get('/verify/{token}', [App\Http\Controllers\verifyController::class, 'acceptOfferView'])->name('acceptOfferView');
        Route::post('/verifyoffer/{token}', [App\Http\Controllers\verifyController::class, 'acceptOffer'])->name('acceptOffer');
        Route::get('/viewPdf/{token}', [App\Http\Controllers\customerViewController::class, 'customerOfferView'])->name('customerOfferView');
        Route::get('/showPdf/{token}', [App\Http\Controllers\customerViewController::class, 'showPdf'])->name('showPdf');
// });


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace' => 'front', 'middleware' => ['auth']], function () {

    // if (App\Models\UserPermission::getMyControl(4))
    // {
    //     Route::get('/', [App\Http\Controllers\front\workerPanel\indexController::class, 'index'])->name('index');
    // }
    
    Route::group(['namespace' => 'home', 'as' => 'home.'], function () {
        Route::get('/', [App\Http\Controllers\front\home\indexController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'company', 'as' => 'company.', 'prefix' => 'company', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\company\indexController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\front\company\indexController::class, 'create'])->name('create');
        Route::post('/create', [App\Http\Controllers\front\company\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\company\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\company\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\company\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\company\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace' => 'contactPerson', 'as' => 'contactPerson.', 'prefix' => 'contactPerson', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\contactPerson\indexController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\front\contactPerson\indexController::class, 'create'])->name('create');
        Route::post('/create', [App\Http\Controllers\front\contactPerson\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\contactPerson\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\contactPerson\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\contactPerson\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\contactPerson\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace' => 'user', 'as' => 'user.', 'prefix' => 'user', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\user\indexController::class, 'index'])->name('index');
        Route::get('/workers', [App\Http\Controllers\front\user\indexController::class, 'workerIndex'])->name('workerIndex');
        Route::get('/create', [App\Http\Controllers\front\user\indexController::class, 'create'])->name('create');
        Route::post('/create', [App\Http\Controllers\front\user\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\user\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\user\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\user\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\user\indexController::class, 'data'])->name('data');
        Route::post('/dataWorker', [App\Http\Controllers\front\user\indexController::class, 'dataWorker'])->name('dataWorker');
    });

    Route::group(['namespace' => 'worker', 'as' => 'worker.', 'prefix' => 'worker', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\worker\indexController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\front\worker\indexController::class, 'create'])->name('create');
        Route::post('/create', [App\Http\Controllers\front\worker\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\worker\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\worker\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\worker\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\worker\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace' => 'task', 'as' => 'task.', 'prefix' => 'task', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\task\indexController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\front\task\indexController::class, 'create'])->name('create');
        Route::get('/createFromOffer/{id}', [App\Http\Controllers\front\task\indexController::class, 'createFromOffer'])->name('createFromOffer');
        Route::post('/create', [App\Http\Controllers\front\task\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\task\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\task\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\task\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\task\indexController::class, 'data'])->name('data');
        Route::get('/detail/{id}', [App\Http\Controllers\front\task\indexController::class, 'detail'])->name('detail');
    });

    Route::group(['namespace' => 'workerPanel', 'as' => 'workerPanel.', 'prefix' => 'workerPanel', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\worker\indexController::class, 'index'])->name('index');
        Route::get('/', [App\Http\Controllers\front\workerPanel\indexController::class, 'index'])->name('index');
        Route::get('/task/{id}', [App\Http\Controllers\front\workerPanel\indexController::class, 'task'])->name('task');
        Route::get('/task/detail/{userId}/{id}', [App\Http\Controllers\front\workerPanel\indexController::class, 'taskDetail'])->name('taskDetail');
        Route::get('/task/edit/{userId}/{id}', [App\Http\Controllers\front\workerPanel\indexController::class, 'taskEdit'])->name('taskEdit');
        Route::post('/task/edit/{userId}/{id}', [App\Http\Controllers\front\workerPanel\indexController::class, 'taskUpdate'])->name('taskUpdate');
        Route::get('/profile/edit/{userId}', [App\Http\Controllers\front\workerPanel\indexController::class, 'profileEdit'])->name('profileEdit');
        Route::post('/profile/edit/{userId}', [App\Http\Controllers\front\workerPanel\indexController::class, 'profileUpdate'])->name('profileUpdate');
        Route::post('/data/{id}', [App\Http\Controllers\front\workerPanel\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace' => 'customer', 'as' => 'customer.', 'prefix' => 'customer', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\customer\indexController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\front\customer\indexController::class, 'create'])->name('create');
        Route::post('/create', [App\Http\Controllers\front\customer\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\customer\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\customer\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\customer\indexController::class, 'delete'])->name('delete');
        Route::get('/detail/{id}', [App\Http\Controllers\front\customer\indexController::class, 'detail'])->name('detail');
        Route::post('/data', [App\Http\Controllers\front\customer\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace' => 'appointment', 'as' => 'appointment.', 'prefix' => 'appointment', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\appointment\indexController::class, 'index'])->name('index');
        Route::get('/create/{id}', [App\Http\Controllers\front\appointment\indexController::class, 'create'])->name('create');
        Route::get('/createFromOffer/{id}/{customer}', [App\Http\Controllers\front\appointment\indexController::class, 'createFromOffer'])->name('createFromOffer');
        Route::post('/create/{id}', [App\Http\Controllers\front\appointment\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\appointment\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\appointment\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\appointment\indexController::class, 'delete'])->name('delete');
        Route::get('/detail/{id}', [App\Http\Controllers\front\appointment\indexController::class, 'detail'])->name('detail');
        Route::post('/data/{id}', [App\Http\Controllers\front\appointment\indexController::class, 'data'])->name('data');
        Route::post('/send-mail', [App\Http\Controllers\front\appointmentMaterial\indexController::class, 'sendEmail'])->name('send.mail');
    });

    Route::group(['namespace' => 'appointmentMaterial', 'as' => 'appointmentMaterial.', 'prefix' => 'appointmentMaterial', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\appointmentMaterial\indexController::class, 'index'])->name('index');
        Route::get('/create/{id}', [App\Http\Controllers\front\appointmentMaterial\indexController::class, 'create'])->name('create');
        Route::post('/create/{id}', [App\Http\Controllers\front\appointmentMaterial\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\appointmentMaterial\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\appointmentMaterial\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\appointmentMaterial\indexController::class, 'delete'])->name('delete');
        Route::get('/detail/{id}', [App\Http\Controllers\front\appointmentMaterial\indexController::class, 'detail'])->name('detail');
        Route::post('/data/{id}', [App\Http\Controllers\front\appointmentMaterial\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace' => 'appointmentService', 'as' => 'appointmentService.', 'prefix' => 'appointmentService', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\appointmentService\indexController::class, 'index'])->name('index');
        Route::get('/create/{id}', [App\Http\Controllers\front\appointmentService\indexController::class, 'create'])->name('create');
        Route::post('/create/{id}', [App\Http\Controllers\front\appointmentService\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\appointmentService\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\appointmentService\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\appointmentService\indexController::class, 'delete'])->name('delete');
        Route::get('/detail/{id}', [App\Http\Controllers\front\appointmentService\indexController::class, 'detail'])->name('detail');
        Route::post('/data/{id}', [App\Http\Controllers\front\appointmentService\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace' => 'offer', 'as' => 'offer.', 'prefix' => 'offer','middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\offer\indexController::class, 'index'])->name('index');
        Route::post('/data/{id}', [App\Http\Controllers\front\offer\indexController::class, 'data'])->name('data');
        Route::get('/updatedOffer/{customerId}/{id}', [App\Http\Controllers\front\offer\indexController::class, 'updatedOffer'])->name('updatedOffer');
        Route::post('/updatedOffer/{customerId}/{id}', [App\Http\Controllers\front\offer\indexController::class, 'updatedData'])->name('updatedData');
        Route::get('/create/{id}', [App\Http\Controllers\front\offer\indexController::class, 'create'])->name('create');
        Route::post('/create/{id}', [App\Http\Controllers\front\offer\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\offer\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\offer\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\offer\indexController::class, 'delete'])->name('delete');
        Route::get('/detail/{id}', [App\Http\Controllers\front\offer\indexController::class, 'detail'])->name('detail');
        Route::get('/pdf', [App\Http\Controllers\front\offer\indexController::class, 'pdf'])->name('pdf');
        Route::get('/showPdf/{id}', [App\Http\Controllers\front\offer\indexController::class, 'showPdf'])->name('showPdf');
        Route::post('/send-mail', [App\Http\Controllers\front\offer\indexController::class, 'sendEmail'])->name('send.mail');
    });

    Route::group(['namespace' => 'invoice', 'as' => 'invoice.', 'prefix' => 'invoice', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\invoice\indexController::class, 'index'])->name('index');
        Route::get('/create/{id}', [App\Http\Controllers\front\invoice\indexController::class, 'create'])->name('create');
        Route::get('/createFromOffer/{id}/{customer}', [App\Http\Controllers\front\invoice\indexController::class, 'createFromOffer'])->name('createFromOffer');
        Route::post('/create/{id}', [App\Http\Controllers\front\invoice\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\invoice\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\invoice\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\invoice\indexController::class, 'delete'])->name('delete');
        Route::get('/detail/{id}', [App\Http\Controllers\front\invoice\indexController::class, 'detail'])->name('detail');
        Route::get('/pdf', [App\Http\Controllers\front\invoice\indexController::class, 'pdf'])->name('pdf');
        Route::get('/showPdf/{id}', [App\Http\Controllers\front\invoice\indexController::class, 'showPdf'])->name('showPdf');
        Route::post('/data/{id}', [App\Http\Controllers\front\invoice\indexController::class, 'data'])->name('data');
        Route::post('/send-mail', [App\Http\Controllers\front\invoice\indexController::class, 'sendEmail'])->name('send.mail');
    });

    Route::group(['namespace' => 'receipt', 'as' => 'receipt.', 'prefix' => 'receipt', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\receipt\indexController::class, 'index'])->name('index');
        Route::get('/create/{id}', [App\Http\Controllers\front\receipt\indexController::class, 'create'])->name('create');
        Route::post('/create/{id}', [App\Http\Controllers\front\receipt\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\receipt\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\receipt\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\receipt\indexController::class, 'delete'])->name('delete');
        Route::get('/detail/{id}', [App\Http\Controllers\front\receipt\indexController::class, 'detail'])->name('detail');
        Route::get('/pdf', [App\Http\Controllers\front\receipt\indexController::class, 'pdf'])->name('pdf');
        Route::get('/showPdf/{id}', [App\Http\Controllers\front\receipt\indexController::class, 'showPdf'])->name('showPdf');
        Route::post('/send-mail', [App\Http\Controllers\front\receipt\indexController::class, 'sendEmail'])->name('send.mail');
        Route::get('/createStandart/{id}/{customer}', [App\Http\Controllers\front\receipt\indexController::class, 'createStandart'])->name('createStandart');
        Route::post('/createStandart/{id}/{customer}', [App\Http\Controllers\front\receipt\indexController::class, 'storeStandart'])->name('storeStandart');
        Route::get('/createReinigung/{id}/{customer}', [App\Http\Controllers\front\receipt\indexController::class, 'createReinigung'])->name('createReinigung');
        Route::post('/data/{id}', [App\Http\Controllers\front\receipt\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace' => 'receiptReinigung', 'as' => 'receiptReinigung.', 'prefix' => 'receiptReinigung', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\receiptReinigung\indexController::class, 'index'])->name('index');
        Route::get('/create/{id}', [App\Http\Controllers\front\receiptReinigung\indexController::class, 'create'])->name('create');
        Route::post('/create/{id}', [App\Http\Controllers\front\receiptReinigung\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\receiptReinigung\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\receiptReinigung\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\receiptReinigung\indexController::class, 'delete'])->name('delete');
        Route::get('/detail/{id}', [App\Http\Controllers\front\receiptReinigung\indexController::class, 'detail'])->name('detail');
        Route::get('/pdf', [App\Http\Controllers\front\receiptReinigung\indexController::class, 'pdf'])->name('pdf');
        Route::get('/showPdf/{id}', [App\Http\Controllers\front\receiptReinigung\indexController::class, 'showPdf'])->name('showPdf');
        Route::post('/data/{id}', [App\Http\Controllers\front\receiptReinigung\indexController::class, 'data'])->name('data');
        Route::post('/send-mail', [App\Http\Controllers\front\receiptReinigung\indexController::class, 'sendEmail'])->name('send.mail');
        Route::get('/createReinigung/{id}/{customer}', [App\Http\Controllers\front\receiptReinigung\indexController::class, 'createReinigung'])->name('createReinigung');
        Route::get('/createReinigung2/{id}/{customer}', [App\Http\Controllers\front\receiptReinigung\indexController::class, 'createReinigung2'])->name('createReinigung2');
        Route::post('/createReinigung/{id}/{customer}', [App\Http\Controllers\front\receiptReinigung\indexController::class, 'storeReinigung'])->name('storeReinigung');
    });



    Route::group(['namespace' => 'product', 'as' => 'product.', 'prefix' => 'product', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\product\indexController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\front\product\indexController::class, 'create'])->name('create');
        Route::post('/create', [App\Http\Controllers\front\product\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\product\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\product\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\product\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\product\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace' => 'tariff', 'as' => 'tariff.', 'prefix' => 'tariff', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\tariff\indexController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\front\tariff\indexController::class, 'create'])->name('create');
        Route::post('/create', [App\Http\Controllers\front\tariff\indexController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\front\tariff\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\tariff\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\tariff\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\tariff\indexController::class, 'data'])->name('data');
    });
});

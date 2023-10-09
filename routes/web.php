<?php

use Illuminate\Support\Facades\Artisan;
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

// Clear application cache:
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return 'Application cache has been cleared';
});

//Clear route cache:
Route::get('/route-cache', function() {
	Artisan::call('route:cache');
    return 'Routes cache has been cleared';
});

//Clear config cache:
Route::get('/config-cache', function() {
 	Artisan::call('config:cache');
 	return 'Config cache has been cleared';
}); 

// Clear view cache:
Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    return 'View cache has been cleared';
});

// Route::middleware(['guest'])->group(function () {
        Route::get('/verify/{token}', [App\Http\Controllers\verifyController::class, 'acceptOfferView'])->name('acceptOfferView');
        Route::post('/verifyoffer/{token}', [App\Http\Controllers\verifyController::class, 'acceptOffer'])->name('acceptOffer');
        Route::get('/verifyoffer/{token}', [App\Http\Controllers\verifyController::class, 'acceptOffer'])->name('acceptOffer');
        Route::get('/rejectoffer/{token}', [App\Http\Controllers\verifyController::class, 'rejectOffer'])->name('rejectOffer');
        Route::post('/rejectoffer/{token}', [App\Http\Controllers\verifyController::class, 'rejectOffer'])->name('rejectOffer');
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
        Route::get('/detail/{id}', [App\Http\Controllers\front\worker\indexController::class, 'detail'])->name('detail');
        Route::get('/delete/{id}', [App\Http\Controllers\front\worker\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\worker\indexController::class, 'data'])->name('data');
        Route::post('/taskData/{id}', [App\Http\Controllers\front\worker\indexController::class, 'taskData'])->name('taskData');
        Route::post('/payStatusChanger/{id}', [App\Http\Controllers\front\worker\indexController::class, 'payStatusChanger'])->name('payStatusChanger');
        Route::get('/payStatusChanger/{id}', [App\Http\Controllers\front\worker\indexController::class, 'payStatusChanger'])->name('payStatusChanger');
    });

    Route::group(['namespace' => 'task', 'as' => 'task.', 'prefix' => 'task', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\task\indexController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\front\task\indexController::class, 'create'])->name('create');
        Route::get('/createFromReceipt/{id}', [App\Http\Controllers\front\task\indexController::class, 'createFromReceipt'])->name('createFromReceipt');
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
        Route::get('/createForm/{id}', [App\Http\Controllers\front\customer\indexController::class, 'createForm'])->name('createForm');
        Route::post('/createForm/{id}', [App\Http\Controllers\front\customer\indexController::class, 'storeForm'])->name('storeForm');
        Route::get('/edit/{id}', [App\Http\Controllers\front\customer\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\customer\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\customer\indexController::class, 'delete'])->name('delete');
        Route::get('/detail/{id}', [App\Http\Controllers\front\customer\indexController::class, 'detail'])->name('detail');
        Route::post('/data', [App\Http\Controllers\front\customer\indexController::class, 'data'])->name('data');
        Route::get('/data', [App\Http\Controllers\front\customer\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace' => 'customerForms', 'as' => 'customerForms.', 'prefix' => 'customerForms', 'middleware' => ['PermissionControl']], function () {
        Route::post('/data', [App\Http\Controllers\front\customerForms\indexController::class, 'data'])->name('data');
        Route::get('/data', [App\Http\Controllers\front\customerForms\indexController::class, 'data'])->name('data');
        Route::get('/detail/{id}', [App\Http\Controllers\front\customerForms\indexController::class, 'detail'])->name('detail');
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
        Route::get('/getOfferte/{id}', [App\Http\Controllers\front\offer\indexController::class, 'getOfferte'])->name('getOfferte');
        Route::post('/noticeUpdate/{id}', [App\Http\Controllers\front\offer\indexController::class, 'noticeUpdate'])->name('noticeUpdate');
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
        // Route::get('/offerPdfPreview/{id}', [App\Http\Controllers\front\offer\indexController::class, 'offerPdfPreview'])->name('offerPdfPreview');
        Route::post('/offerPdfPreview/{id}', [App\Http\Controllers\front\offer\indexController::class, 'offerPdfPreview'])->name('offerPdfPreview');
        Route::post('/offerPdfPreviewTest/{id}', [App\Http\Controllers\front\offer\indexController::class, 'offerPdfPreviewTest'])->name('offerPdfPreviewTest');
        Route::post('/offerPdfPreviewEdit/{id}', [App\Http\Controllers\front\offer\indexController::class, 'offerPdfPreviewEdit'])->name('offerPdfPreviewEdit');
        Route::post('/send-mail', [App\Http\Controllers\front\offer\indexController::class, 'sendEmail'])->name('send.mail');
        Route::get('/manuelAccept/{id}', [App\Http\Controllers\front\offer\indexController::class, 'manuelAccept'])->name('manuelAccept');
        Route::get('/manuelReject/{id}', [App\Http\Controllers\front\offer\indexController::class, 'manuelReject'])->name('manuelReject');
        Route::get('/manuelDefault/{id}', [App\Http\Controllers\front\offer\indexController::class, 'manuelDefault'])->name('manuelDefault');
        Route::get('/dateTester', [App\Http\Controllers\front\offer\indexController::class, 'dateTester'])->name('dateTester');
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
        Route::post('/docTaken/{id}/{type}', [App\Http\Controllers\front\receipt\indexController::class, 'docTaken'])->name('docTaken');
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

    Route::group(['namespace' => 'expense', 'as' => 'expense.', 'prefix' => 'expense', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\expense\indexController::class, 'index'])->name('index');
        Route::get('/editUmzug/{id}', [App\Http\Controllers\front\expense\indexController::class, 'editUmzug'])->name('editUmzug');
        Route::post('/editUmzug/{id}', [App\Http\Controllers\front\expense\indexController::class, 'updateUmzug'])->name('updateUmzug');
        Route::get('/editReinigung/{id}', [App\Http\Controllers\front\expense\indexController::class, 'editReinigung'])->name('editReinigung');
        Route::post('/editReinigung/{id}', [App\Http\Controllers\front\expense\indexController::class, 'updateReinigung'])->name('updateReinigung');
        Route::post('/create', [App\Http\Controllers\front\expense\indexController::class, 'store'])->name('store');
        Route::get('/deleteUmzug/{id}', [App\Http\Controllers\front\expense\indexController::class, 'deleteUmzug'])->name('deleteUmzug');
        Route::get('/deleteReinigung/{id}', [App\Http\Controllers\front\expense\indexController::class, 'deleteReinigung'])->name('deleteReinigung');
        Route::post('/data', [App\Http\Controllers\front\expense\indexController::class, 'data'])->name('data');
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

    Route::group(['namespace' => 'statistics', 'as' => 'statistics.', 'prefix' => 'statistics', 'middleware' => ['PermissionControl']], function () {
        Route::get('/', [App\Http\Controllers\front\statistics\indexController::class, 'index'])->name('index');
        Route::get('/offerte', [App\Http\Controllers\front\statistics\indexController::class, 'offer'])->name('offer');
        Route::get('/quittung', [App\Http\Controllers\front\statistics\indexController::class, 'receipt'])->name('receipt');
        Route::get('/edit/{id}', [App\Http\Controllers\front\statistics\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\statistics\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [App\Http\Controllers\front\statistics\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\statistics\indexController::class, 'data'])->name('data');
        Route::post('/offerData', [App\Http\Controllers\front\statistics\indexController::class, 'offerData'])->name('offerData');
        Route::post('/receiptData', [App\Http\Controllers\front\statistics\indexController::class, 'receiptData'])->name('receiptData');
    });
});

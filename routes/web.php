<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FlowController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\UserprofileController;

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


Route::match(['get', 'head'], '/', function () {
    return view('index');
})->name('index');



// **************************************************** A  U  T  H  E  N  T  I  C  A  T  E************************************************
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function(){

            // **************************************************** U S E R P R O F I L E************************************************
        Route::resource('/userdetail', UserDetailController::class);


        // ****************************************************  U S E R  P R O F I L E ************************************************
        Route::resource('/userprofile', UserprofileController::class);
        Route::post('/update_user/{user_id}', [UserprofileController::class, 'update_user'])->name('update_user');
        Route::get('/update_status/{user_id}', [UserprofileController::class, 'update_status'])->name('update_status');
        Route::get('/profile', [UserprofileController::class, 'profile'])->name('profile');
        Route::get('/show_profile/{user_id}', [UserprofileController::class, 'show_profile'])->name('show_profile');
        Route::get('/show_user_profile/{user_id}', [UserprofileController::class, 'show_user_profile'])->name('show_user_profile');
        Route::post('/save-token', [UserprofileController::class, 'saveToken'])->name('save-token');
        Route::post('/send-notification', [UserprofileController::class, 'sendNotification'])->name('send.notification');
        // Route::post('/register', [UserprofileController::class,'create'])->name('register');


        // **************************************************** P  R  O  J  E  C  T ************************************************

        Route::get('/create', [ProjectController::class, 'create']);
        // Route::get('/read', [ProjectController::class, 'read']);
        Route::post('/project_add', [ProjectController::class, 'store'])->name('projectstore');
        Route::post('/remove_member', [ProjectController::class, 'remove_member'])->name('remove_member');

        Route::prefix('project') ->group(function(){
            Route::match(['post','get', 'head'],'/list', [ProjectController::class, 'index'])->name('project.admin');
            Route::get('/list/{user_id}', [ProjectController::class, 'indexuser'])->name('project.user');
            Route::get('/member-list/{project_id}', [ProjectController::class, 'list_member'])->name('project.list_member');
        });

        // Route::middleware(['auth','user-role:1'])->group(function(){
        // });

        // **************************************************** P  R  O  J  E  C  T 2 ************************************************
        Route::resource('newproject', ProjectController::class);
        Route::get('/project_list', [ProjectController::class, 'read']);
        Route::get('/project_show/{projectid}', [ProjectController::class, 'show']);
        Route::get('/project_view/{projectid}', [ProjectController::class, 'view']);
        Route::post('/project_update/{projectid}', [ProjectController::class, 'update']);
        Route::get('/project_list/{user_id}', [ProjectController::class, 'readuser']);
        Route::get('/assign_project_form/{project_id}', [ProjectController::class, 'assign_project_form'])->name('assign_project_form');
        Route::post('/assign_member_action}', [ProjectController::class, 'assign_member_action'])->name('assign_member_action');

        // **************************************************** M O  D  U  L  S ************************************************
        Route::get('modulindex/{projectId}', [ModulController::class, 'index'])->name('modulindex');
        Route::resource('modul', ModulController::class);
        Route::get('/modul_edit/{modul_id}', [ModulController::class, 'edit']);
        Route::get('/modul_show/{modul_id}', [ModulController::class, 'show']);

        // **************************************************** F  L  O  W ************************************************
        Route::get('flowindex/{modul_id},{project_id}', [FlowController::class, 'index'])->name('flowindex');
        Route::get('/flow_senarai/{modul_id}/{flow_name}/{flow_owner}', [FlowController::class, 'read']);
        Route::get('flow_create/{modul_id}', [FlowController::class, 'create'])->name('flow_create');
        Route::post('/flow_update', [FlowController::class, 'update'])->name('flow_update');
        Route::get('/flow_show/{flow_id}', [FlowController::class, 'show']);
        Route::get('/flow_edit/{flow_id}', [FlowController::class, 'edit']);
        Route::resource('flow', FlowController::class);


        // **************************************************** F  I  L  E  S ************************************************
        Route::get('/fileindex/{project_id}', [FileController::class, 'index'])->name('fileindex');
        Route::resource('file',FileController::class);
        Route::put('/update_file/{file_id}', [FileController::class, 'update_file'])->name('update_file');
        Route::get('/file_edit/{file_id}', [FileController::class, 'edit']);
        Route::get('/file_show/{file_id}', [FileController::class, 'show']);
        Route::get('/file_list/{project_id}', [FileController::class, 'index'])->name('file_list');




        // **************************************************** F  U  N  C  T  I  O  N  S ************************************************
        Route::resource('/function', FunctionController::class);
        Route::get('/functionindex/{fileId}/{e_project_id}', [FunctionController::class, 'index'])->name('functionindex');
        Route::get('/functionShow/{functionId}/{e_project_id}', [FunctionController::class, 'show'])->name('functionShow');
        Route::get('/functionEdit/{functionId}/{e_project_id}', [FunctionController::class, 'edit'])->name('functionEdit');
        Route::post('/functionShow/create_view', [FunctionController::class, 'store_view'])->name('store_view');
        Route::post('/functionShow/update_view', [FunctionController::class, 'update_view'])->name('update_view');
        Route::get('/functioncreate/create/{file_id}/{e_project_id}', [FunctionController::class, 'create'])->name('functioncreate');
        Route::get('/getfunction/{file_id}', [FunctionController::class, 'getfunction'])->name('getfunction');
        Route::get('/getfunction_detail/{function_id}', [FunctionController::class, 'getfunction_detail'])->name('getfunction_detail');
        Route::get('/getfunction_detail_byfile/{file_id}', [FunctionController::class, 'getfunction_detail_byfile'])->name('getfunction_detail_byfile');

        // Auth::routes();

        // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


});

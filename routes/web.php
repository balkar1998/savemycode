<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxFolderController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::get('/dashboard',[AjaxFolderController::class,'index'])->middleware(['auth'])->name('dashboard');
Route::post('createfolder',[AjaxFolderController::class,'store']);
Route::post('createfile',[AjaxFolderController::class,'storefile']);
Route::post('savefile',[AjaxFolderController::class,'storefilecontent']);

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\Zaions\TestingController;
use App\Models\ZTech\Batch;
use App\Zaions\Enums\RolesEnum;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

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

// Route::get('/z-testing', [TestingController::class, 'zTestingRouteRes']);
Route::get('/z-testing', function () {


    // before 21-11-23
    // $wsRoles = [
    //     RolesEnum::ws_administrator->name => RolesEnum::ws_administrator->name,
    //     RolesEnum::ws_contributor->name => RolesEnum::ws_contributor->name,
    //     RolesEnum::ws_approver->name => RolesEnum::ws_approver->name,
    //     RolesEnum::ws_guest->name => RolesEnum::ws_guest->name
    // ];

    // $roles = Role::whereIn('name', $wsRoles)->pluck('name', 'id');


    // dd($roles);


    // on 21-11-23 testing what data i get from plunk
    $batches = Batch::plunk('title', 'id')->get();
    dd($batches);
});

Route::redirect('/', config('nova.path'));

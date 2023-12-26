<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\DashboardController;

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
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(["middleware" => "auth", "prefix" => "admin", "as" => "admin."], function () {
    // AuthController
    // Route::get("logout", [AuthController::class, "logout"])->name("auth.logout");

    // DashboardController
    Route::get("dashboard", [DashboardController::class, "index"])->name("dashboard.index");

    // ProductController
    Route::resource("buses", BusController::class);

    // RouteController
    Route::resource("routes", RouteController::class);

    // TripController
    Route::resource("trips", TripController::class);

    // TicketController
    Route::resource("tickets", TicketController::class)->except("edit");
    Route::get("sub-route-ajax", [TicketController::class, "subRouteAjax"])->name("tickets.sub_route_ajax");
    Route::get("ticket-ajax", [TicketController::class, "ticketAjax"])->name("tickets.tickets_ajax");
    Route::post("ticket-create-ajax", [TicketController::class, "ticketCreateAjax"])->name("tickets.tickets_create_ajax");
});

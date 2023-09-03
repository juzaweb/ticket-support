<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

use Juzaweb\TicketSupport\Http\Controllers\Backend\TicketSupportController;
use Juzaweb\TicketSupport\Http\Controllers\Backend\TicketSupportTypeController;

Route::jwResource('ticket-supports/tickets', TicketSupportController::class);
Route::post('ticket-supports/tickets/{id}/comment', [TicketSupportController::class, 'comment'])
    ->name('admin.ticket-supports.comment');
Route::jwResource('ticket-supports/types', TicketSupportTypeController::class);

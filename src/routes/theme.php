<?php

use Juzaweb\TicketSupport\Http\Controllers\Frontend\TicketSupportController;

Route::group(
    ['prefix' => 'ajax/ticket-support'],
    function () {
        Route::post('/submit', [TicketSupportController::class, 'submit'])->name('jwts.ticket-support.submit');
        Route::post('/{id}/comment', [TicketSupportController::class, 'comment'])->name('jwts.ticket-support.comment');
        Route::get(
            '/{id}/{attachmentId}/download-attachments',
            [TicketSupportController::class, 'downloadAttachment']
        )->name('jwts.ticket-support.download-attachment');
    }
);

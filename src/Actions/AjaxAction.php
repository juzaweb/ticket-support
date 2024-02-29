<?php

namespace Juzaweb\TicketSupport\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\TicketSupport\Http\Controllers\Frontend\TicketSupportController;

class AjaxAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->addAction(Action::FRONTEND_INIT, [$this, 'addFrontendAjax']);
    }

    /**
     * @throws \Exception
     */
    public function addFrontendAjax(): void
    {
        // $this->hookAction->registerFrontendAjax(
        //     'ticket-support.submit',
        //     [
        //         'auth' => true,
        //         'method' => 'post',
        //         'callback' => [TicketSupportController::class, 'submit'],
        //     ]
        // );

        // $this->hookAction->registerFrontendAjax(
        //     'ticket-support.comment',
        //     [
        //         'auth' => true,
        //         'method' => 'post',
        //         'callback' => [TicketSupportController::class, 'submit'],
        //     ]
        // );

        $this->hookAction->registerFrontendAjax(
            'ticket-support.download-attachments',
            [
                'auth' => true,
                'method' => 'get',
                'callback' => [TicketSupportController::class, 'downloadAttachment'],
            ]
        );
    }
}

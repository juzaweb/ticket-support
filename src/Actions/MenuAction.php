<?php

namespace Juzaweb\TicketSupport\Actions;

use Juzaweb\CMS\Abstracts\Action;

class MenuAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->addAction(Action::BACKEND_INIT, [$this, 'addAdminMenus']);
        $this->addAction(Action::INIT_ACTION, [$this, 'addMailHooks']);
    }

    public function addAdminMenus(): void
    {
        $this->hookAction->addAdminMenu(
            __('Ticket Support'),
            'ticket-supports',
            [
                'icon' => 'fa fa-ticket',
                'position' => 30,
            ]
        );

        $this->hookAction->registerAdminPage(
            'ticket-supports.tickets',
            [
                'title' => __('Tickets'),
                'menu' => [
                    'icon' => 'fa fa-ticket',
                    'parent' => 'ticket-supports',
                    'position' => 1,
                ],
            ]
        );

        $this->hookAction->registerAdminPage(
            'ticket-supports.types',
            [
                'title' => __('Types'),
                'menu' => [
                    'icon' => 'fa fa-list',
                    'parent' => 'ticket-supports',
                    'position' => 30,
                ],
            ]
        );
    }

    public function addMailHooks(): void
    {
        $this->hookAction->registerEmailHook(
            'ticket_support_submited',
            [
                'label' => 'Ticket Support submited',
                'params' => [
                    'name' => 'Author name submit ticket',
                    'email' => 'Author email submit ticket',
                    'ticket' => 'Title Ticket',
                ],
            ]
        );

        $this->hookAction->registerEmailHook(
            'ticket_support_comment',
            [
                'label' => 'Ticket Support comment',
                'params' => [
                    'name' => 'Author name comment ticket',
                    'email' => 'Author email comment ticket',
                    'ticket' => 'Title Ticket',
                ],
            ]
        );
    }
}

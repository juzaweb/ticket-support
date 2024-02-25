<?php
namespace Juzaweb\TicketSupport\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\TicketSupport\Http\Resources\TicketSupportCollection;
use Juzaweb\TicketSupport\Http\Resources\TicketSupportTypeCollection;
use Juzaweb\TicketSupport\Models\TicketSupport;
use Juzaweb\TicketSupport\Models\TicketSupportType;

class FrontendAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::FRONTEND_INIT, [$this, 'registerProfilePages']);
    }

    public function registerProfilePages(): void
    {
        $this->hookAction->registerProfilePage(
            'list-ticket-support',
            [
               'title' => __('List Ticket Support'),
               'contents' => 'jwts::frontend.profile.list_ticket_support',
               'data' => [
                    'ticketSupports' => function () {
                        $posts = TicketSupport::with('type')->paginate(10);

                        return TicketSupportCollection::make($posts)
                            ->response()
                            ->getData(true);
                    }
                ],
            ]
        );

        $this->hookAction->registerProfilePage(
            'create-ticket-support',
            [
               'title' => __('Create Ticket Support'),
               'contents' => 'jwts::frontend.profile.create_ticket_support',
               'data' => [
                    'types' => function () {
                        $types = TicketSupportType::get();

                        return TicketSupportTypeCollection::make($types)
                            ->response()
                            ->getData(true)['data'];
                    }
                ],
            ]
        );
    }
}

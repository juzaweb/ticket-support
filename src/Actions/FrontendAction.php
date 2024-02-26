<?php
namespace Juzaweb\TicketSupport\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\TicketSupport\Http\Resources\TicketSupportCollection;
use Juzaweb\TicketSupport\Http\Resources\TicketSupportCommentCollection;
use Juzaweb\TicketSupport\Http\Resources\TicketSupportResource;
use Juzaweb\TicketSupport\Http\Resources\TicketSupportTypeCollection;
use Juzaweb\TicketSupport\Models\TicketSupport;
use Juzaweb\TicketSupport\Models\TicketSupportComment;
use Juzaweb\TicketSupport\Models\TicketSupportType;

class FrontendAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::FRONTEND_INIT, [$this, 'registerProfilePages']);
    }

    public function registerProfilePages(): void
    {
        $user = request()->user();

        $this->hookAction->registerProfilePage(
            'ticket-supports',
            [
               'title' => __('List Ticket Support'),
               'contents' => 'jwts::frontend.profile.list_ticket_support',
               'data' => [
                    'ticketSupports' => function () use ($user) {
                        $posts = TicketSupport::with('type')->where(['created_by' => $user->id])->paginate(10);

                        return TicketSupportCollection::make($posts)
                            ->response()
                            ->getData(true);
                    },
                    'ticketSupport' => function () {
                        if ($id = request()->input('id')) {
                            $ticketSupport = TicketSupport::with(
                                [
                                    'attachments' => fn ($q) => $q->whereNull('comment_id'),
                                ]
                            )->find($id);

                            return TicketSupportResource::make($ticketSupport)
                                ->response()
                                ->getData(true)['data'];
                        }
                        return collect();
                    },
                    'ticketSupportComments' => function () {
                        if ($id = request()->input('id')) {
                            $commemts = TicketSupportComment::with('attachments')->where('ticket_support_id', $id)->get();

                            return TicketSupportCommentCollection::make($commemts)
                                ->response()
                                ->getData(true)['data'];
                        }
                        return collect();
                    },
                ],
            ]
        );

        $this->hookAction->registerProfilePage(
            'ticket-supports.create',
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

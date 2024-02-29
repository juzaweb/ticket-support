<?php

namespace Juzaweb\TicketSupport\Providers;

use Juzaweb\CMS\Support\ServiceProvider;
use Juzaweb\TicketSupport\Actions\AjaxAction;
use Juzaweb\TicketSupport\Actions\FrontendAction;
use Juzaweb\TicketSupport\Actions\MenuAction;
use Juzaweb\TicketSupport\Repositories\TicketSupportAttachmentRepository;
use Juzaweb\TicketSupport\Repositories\TicketSupportAttachmentRepositoryEloquent;
use Juzaweb\TicketSupport\Repositories\TicketSupportCommentRepository;
use Juzaweb\TicketSupport\Repositories\TicketSupportCommentRepositoryEloquent;
use Juzaweb\TicketSupport\Repositories\TicketSupportRepository;
use Juzaweb\TicketSupport\Repositories\TicketSupportRepositoryEloquent;
use Juzaweb\TicketSupport\Repositories\TicketSupportTypeRepository;
use Juzaweb\TicketSupport\Repositories\TicketSupportTypeRepositoryEloquent;

class TicketSupportServiceProvider extends ServiceProvider
{
    public array $bindings = [
        TicketSupportTypeRepository::class => TicketSupportTypeRepositoryEloquent::class,
        TicketSupportRepository::class => TicketSupportRepositoryEloquent::class,
        TicketSupportCommentRepository::class => TicketSupportCommentRepositoryEloquent::class,
        TicketSupportAttachmentRepository::class => TicketSupportAttachmentRepositoryEloquent::class,
    ];

    public function boot()
    {
        $this->registerHookActions([MenuAction::class, AjaxAction::class, FrontendAction::class]);
    }

    public function register()
    {
        //
    }
}

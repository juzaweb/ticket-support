<?php

namespace Juzaweb\TicketSupport\Http\Controllers\Backend;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Backend\Http\Controllers\Backend\PageController;
use Juzaweb\CMS\Abstracts\DataTable;
use Juzaweb\CMS\Traits\ResourceController;
use Juzaweb\TicketSupport\Http\Datatables\TicketSupportTypeDatatable;
use Juzaweb\TicketSupport\Models\TicketSupportType;

class TicketSupportTypeController extends PageController
{
    use ResourceController;

    protected string $viewPrefix = 'jwts::backend.ticket_support_type';

    public function getBreadcrumbPrefix(...$params) : void
    {
        $this->addBreadcrumb(
            [
                'title' => __('Ticket Support'),
                'url' => action([TicketSupportController::class, 'index'])
            ]
        );
    }

    protected function getDataTable(...$params): DataTable
    {
        return new TicketSupportTypeDatatable();
    }

    protected function validator(array $attributes, ...$params): ValidatorContract
    {
        return Validator::make(
            $attributes,
            [
                // Rules
            ]
        );
    }

    protected function getModel(...$params): string
    {
        return TicketSupportType::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('Types');
    }
}

<?php

namespace Juzaweb\TicketSupport\Repositories;

use Juzaweb\CMS\Repositories\BaseRepositoryEloquent;
use Juzaweb\TicketSupport\Models\TicketSupportType;

class TicketSupportTypeRepositoryEloquent extends BaseRepositoryEloquent implements TicketSupportTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return TicketSupportType::class;
    }
}

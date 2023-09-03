<?php

namespace Juzaweb\TicketSupport\Repositories;

use Juzaweb\CMS\Repositories\BaseRepositoryEloquent;
use Juzaweb\CMS\Repositories\Criterias\SortCriteria;
use Juzaweb\CMS\Traits\Criterias\UseFilterCriteria;
use Juzaweb\CMS\Traits\Criterias\UseSearchCriteria;
use Juzaweb\CMS\Traits\Criterias\UseSortableCriteria;
use Juzaweb\TicketSupport\Models\TicketSupport;

class TicketSupportRepositoryEloquent extends BaseRepositoryEloquent implements TicketSupportRepository
{
    use UseSearchCriteria, UseFilterCriteria, UseSortableCriteria;

    protected array $searchableFields = ['title'];
    protected array $filterableFields = ['support_type_id', 'created_by', 'status'];
    protected array $sortableFields = ['id', 'title', 'status'];
    protected array $sortableDefaults = ['created_at' => 'DESC'];

    public function boot(): void
    {
        $this->pushCriteria(SortCriteria::make([]));
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return TicketSupport::class;
    }
}

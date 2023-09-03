<?php

namespace Juzaweb\TicketSupport\Repositories;

use Juzaweb\CMS\Repositories\BaseRepositoryEloquent;
use Juzaweb\CMS\Repositories\Criterias\SortCriteria;
use Juzaweb\CMS\Traits\Criterias\UseFilterCriteria;
use Juzaweb\CMS\Traits\Criterias\UseSortableCriteria;
use Juzaweb\TicketSupport\Models\TicketSupportComment;

/**
 * Class TicketSupportCommentRepository.
 *
 * @package namespace Juzaweb\TicketSupport\Http\Repositorys;
 */
class TicketSupportCommentRepositoryEloquent extends BaseRepositoryEloquent implements TicketSupportCommentRepository
{
    use UseSortableCriteria, UseFilterCriteria;

    protected array $filterableFields = ['ticket_support_id', 'created_by'];
    protected array $sortableFields = ['id'];
    protected array $sortableDefaults = ['id' => 'ASC'];

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
        return TicketSupportComment::class;
    }
}

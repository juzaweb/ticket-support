<?php

namespace Juzaweb\TicketSupport\Repositories;

use Juzaweb\CMS\Repositories\BaseRepository;
use Juzaweb\CMS\Repositories\Interfaces\FilterableInterface;
use Juzaweb\CMS\Repositories\Interfaces\SearchableInterface;
use Juzaweb\CMS\Repositories\Interfaces\SortableInterface;

interface TicketSupportRepository extends BaseRepository, SearchableInterface, FilterableInterface, SortableInterface
{
    //
}

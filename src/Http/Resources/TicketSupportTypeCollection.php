<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\TicketSupport\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TicketSupportTypeCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return $this->collection->map(
            fn($item) => [
                'id' => $item->id,
                'name' => $item->name,
            ]
        )->toArray();
    }
}

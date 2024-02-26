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

class TicketSupportAttachmentCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return $this->collection->map(
            fn($item) => [
                'id' => $item->id,
                'path' => $item->path,
                'name' => $item->name,
                'extension' => $item->extension,
                'minetype' => $item->minetype,
            ]
        )->toArray();
    }
}

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

class TicketSupportCommentCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return $this->collection->map(
            fn($item) => [
                'id' => $item->id,
                'content' => htmlentities($item->content),
                'attachments' => TicketSupportAttachmentCollection::make($item->attachments),
                'created_by' => [
                    'id' => $item->createdBy?->id,
                    'name' => $item->createdBy?->name,
                    'email' => $item->createdBy?->email,
                ],
                'created_at' => jw_date_format($item->created_at),
            ]
        )->toArray();
    }
}

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

class TicketSupportCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return $this->collection->map(
            fn($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'type' => [
                    'name' => $item->type->name,
                ],
                'created_by' => [
                    'name' => $item->user?->name,
                    'email' => $item->user?->email,
                ],
                'status' => $item->status,
                'status_label' => $item->status_label,
                'product_id' => $item->product_id,
                'created_at' => jw_date_format($item->created_at),
            ]
        )->toArray();
    }
}

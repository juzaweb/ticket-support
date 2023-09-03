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

use Illuminate\Http\Resources\Json\JsonResource;

class TicketSupportResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'content' => htmlentities($this->resource->content),
            'created_by' => [
                'name' => $this->resource->createdBy?->name,
            ],
            'type' => [
                'name' => $this->resource->type?->name,
            ],
            'status' => $this->resource->status,
            'status_label' => $this->resource->status_label,
            'product_id' => $this->resource->product_id,
            'created_at' => jw_date_format($this->resource->created_at),
        ];
    }
}

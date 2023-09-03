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

class TicketSupportCommentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'content' => htmlentities($this->resource->content),
            'created_at' => jw_date_format($this->resource->created_at),
            'created_by' => [
                'name' => $this->createdBy?->name,
            ],
        ];
    }
}

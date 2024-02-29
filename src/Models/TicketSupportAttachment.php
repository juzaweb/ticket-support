<?php

namespace Juzaweb\TicketSupport\Models;

use Juzaweb\CMS\Models\Model;

/**
 * Juzaweb\TicketSupport\Models\TicketSupportAttachment
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportAttachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportAttachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportAttachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportAttachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportAttachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportAttachment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportAttachment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TicketSupportAttachment extends Model
{
    public $timestamps = false;
    protected $table = 'jwts_ticket_support_attachments';
    protected $fillable = [
        'path',
        'name',
        'extension',
        'minetype',
        'ticket_support_id',
        'comment_id',
    ];
}

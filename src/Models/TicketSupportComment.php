<?php

namespace Juzaweb\TicketSupport\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Models\User;
use Juzaweb\CMS\Traits\UseChangeBy;

/**
 * Juzaweb\TicketSupport\Models\TicketSupportComment
 *
 * @property int $id
 * @property string $content
 * @property array|null $attachments
 * @property string $ticket_support_id
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Juzaweb\CMS\Models\User|null $createdBy
 * @property-read \Juzaweb\CMS\Models\User|null $updatedBy
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment whereAttachments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment whereTicketSupportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TicketSupportComment extends Model
{
    use UseChangeBy;

    protected $table = 'jwts_ticket_support_comments';

    protected $fillable = [
        'content',
        'attachments',
        'ticket_support_id',
        'created_by',
    ];

    protected $casts = ['attachments' => 'array'];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(TicketSupport::class, 'ticket_support_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}

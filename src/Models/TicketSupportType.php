<?php

namespace Juzaweb\TicketSupport\Models;

use Juzaweb\CMS\Models\Model;

/**
 * Juzaweb\TicketSupport\Models\TicketSupportType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportType query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TicketSupportType extends Model
{
    protected $table = 'jwts_ticket_support_types';
    protected $fillable = [
        'name',
    ];
}

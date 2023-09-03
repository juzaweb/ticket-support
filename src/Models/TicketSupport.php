<?php

namespace Juzaweb\TicketSupport\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Juzaweb\Backend\Models\Post;
use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Models\User;
use Juzaweb\CMS\Traits\ResourceModel;
use Juzaweb\CMS\Traits\UseChangeBy;
use Juzaweb\CMS\Traits\UUIDPrimaryKey;
use Juzaweb\Ecommerce\Models\Product;

/**
 * Juzaweb\TicketSupport\Models\TicketSupport
 *
 * @property string $id
 * @property int $support_type_id
 * @property string $title
 * @property string|null $content
 * @property array|null $attachments
 * @property int|null $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, TicketSupportComment> $comments
 * @property-read int|null $comments_count
 * @property-read User|null $createdBy
 * @property-read string $status_label
 * @property-read Post|null $product
 * @property-read User|null $updatedBy
 * @method static Builder|TicketSupport newModelQuery()
 * @method static Builder|TicketSupport newQuery()
 * @method static Builder|TicketSupport query()
 * @method static Builder|TicketSupport whereAttachments($value)
 * @method static Builder|TicketSupport whereContent($value)
 * @method static Builder|TicketSupport whereCreatedAt($value)
 * @method static Builder|TicketSupport whereCreatedBy($value)
 * @method static Builder|TicketSupport whereFilter($params = [])
 * @method static Builder|TicketSupport whereId($value)
 * @method static Builder|TicketSupport whereSupportTypeId($value)
 * @method static Builder|TicketSupport whereTitle($value)
 * @method static Builder|TicketSupport whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TicketSupport extends Model
{
    use UUIDPrimaryKey, UseChangeBy, ResourceModel;

    protected $keyType = 'string';

    protected $table = 'jwts_ticket_supports';

    protected $fillable = [
        'support_type_id',
        'title',
        'content',
        'created_by',
        'attachments',
        'product_id',
        'status',
    ];

    protected $casts = ['attachments' => 'array'];

    protected $appends = ['status_label'];

    const STATUS_PENDING = 'pending';
    const STATUS_REPLIED = 'replied';
    const STATUS_CLOSE = 'close';

    public static function getStatuses(): array
    {
        return [
            static::STATUS_PENDING => __('Pending'),
            static::STATUS_REPLIED => __('Replied'),
            static::STATUS_CLOSE => __('Close'),
        ];
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TicketSupportComment::class, 'ticket_support_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TicketSupportType::class, 'support_type_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            static::STATUS_REPLIED => __('Replied'),
            self::STATUS_CLOSE => __('Close'),
            default => __('Pending'),
        };
    }
}

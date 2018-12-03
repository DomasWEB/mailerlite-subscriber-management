<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Subscriber
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $state
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Field[] $fields
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscriber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscriber query()
 * @mixin \Eloquent
 */
class Subscriber extends Model
{
    const STATE_ACTIVE = 'active';
    const STATE_UNSUBSCRIBED = 'unsubscribed';
    const STATE_JUNK = 'junk';
    const STATE_BOUNCED = 'bounced';
    const STATE_UNCONFIRMED = 'unconfirmed';

    const STATES = [
        self::STATE_ACTIVE,
        self::STATE_UNSUBSCRIBED,
        self::STATE_JUNK,
        self::STATE_BOUNCED,
        self::STATE_UNCONFIRMED,
    ];

    protected $fillable = [
        'email',
        'name',
        'state',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fields(): BelongsToMany
    {
        return $this->belongsToMany(Field::class, 'subscriber_fields')
                    ->withPivot('value');
    }
}

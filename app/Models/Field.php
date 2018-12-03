<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Field
 *
 * @property int $id
 * @property string $title
 * @property string $key
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscriber[] $subscribers
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Field query()
 * @mixin \Eloquent
 */
class Field extends Model
{
    const TYPE_DATE = 'date';
    const TYPE_NUMBER = 'number';
    const TYPE_STRING = 'string';
    const TYPE_BOOLEAN = 'boolean';

    const TYPES = [
        self::TYPE_DATE,
        self::TYPE_NUMBER,
        self::TYPE_STRING,
        self::TYPE_BOOLEAN,
    ];

    protected $fillable = [
        'title',
        'type',
    ];

    /**
     * @param string $value
     *
     * @return void
     */
    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = $value;
        $this->attributes['key']   = str_slug($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class, 'subscriber_fields')
                    ->withPivot('value');
    }

    /**
     * Validate value by field type
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function validValue($value): bool
    {
        // Validate number type
        if ($this->type == self::TYPE_NUMBER && ! is_numeric($value)) {
            return false;
        }

        // Validate boolean type
        if ($this->type == self::TYPE_BOOLEAN && ! in_array($value, [0, 1, "0", "1", false, true], true)) {
            return false;
        }

        // Validate date type
        if ($this->type == self::TYPE_DATE) {
            try {
                Carbon::parse($value);
            } catch (\Exception $exception) {
                return false;
            }
        }

        // Woohoo, string!
        return true;
    }
}

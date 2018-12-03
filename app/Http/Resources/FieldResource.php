<?php

namespace App\Http\Resources;

use App\Models\Field;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class FieldResource
 *
 * @package App\Http\Resources
 * @author Dominykas Tijūnaitis (dominykas@tijunaitis.lt)
 *
 * @mixin Field
 */
class FieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'key'        => $this->key,
            'type'       => $this->type,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'value'      => $this->whenPivotLoaded('subscriber_fields', function () {
                return $this->getRelation('pivot')->value;
            }),
        ];
    }
}

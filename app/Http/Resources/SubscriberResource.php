<?php

namespace App\Http\Resources;

use App\Models\Subscriber;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SubscriberResource
 *
 * @package App\Http\Resources
 * @author Dominykas Tijūnaitis (dominykas@tijunaitis.lt)
 *
 * @mixin Subscriber
 */
class SubscriberResource extends JsonResource
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
            'name'       => $this->name,
            'email'      => $this->email,
            'state'      => $this->state,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'fields'     => $this->whenLoaded('fields', function () {
                return FieldResource::collection($this->fields);
            }),
            'value'      => $this->whenPivotLoaded('subscriber_fields', function () {
                return $this->getRelation('pivot')->value;
            }),
        ];
    }
}

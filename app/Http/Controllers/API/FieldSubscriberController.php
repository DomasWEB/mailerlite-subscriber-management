<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriberResource;
use App\Models\Field;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class FieldSubscriberController
 *
 * @package App\Http\Controllers\API
 * @author Dominykas Tijūnaitis (dominykas@tijunaitis.lt)
 */
class FieldSubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Field $field
     *
     * @return AnonymousResourceCollection
     */
    public function index(Field $field): AnonymousResourceCollection
    {
        return SubscriberResource::collection($field->subscribers()->paginate());
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Subscriber\StoreRequest;
use App\Http\Requests\API\Subscriber\UpdateRequest;
use App\Http\Resources\SubscriberResource;
use App\Models\Field;
use App\Models\Subscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class SubscriberController
 *
 * @package App\Http\Controllers\API
 * @author Dominykas Tijūnaitis (dominykas@tijunaitis.lt)
 */
class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return SubscriberResource::collection(Subscriber::with('fields')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     *
     * @return SubscriberResource
     */
    public function store(StoreRequest $request): SubscriberResource
    {
        $data = $request->validated();

        $subscriber        = new Subscriber();
        $subscriber->state = Subscriber::STATE_ACTIVE;
        $subscriber->fill($data);
        $subscriber->save();

        if (array_has($data, 'fields')) {
            foreach (array_get($data, 'fields') as $fieldData) {
                $fieldId = Field::where('key', $fieldData['key'])->first(['id'])->id;
                $subscriber->fields()->attach($fieldId, ['value' => $fieldData['value']]);
            }
        }

        return new SubscriberResource($subscriber->load('fields'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Subscriber $subscriber
     *
     * @return SubscriberResource
     */
    public function show(Subscriber $subscriber): SubscriberResource
    {
        return new SubscriberResource($subscriber->load('fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param  Subscriber $subscriber
     *
     * @return SubscriberResource
     */
    public function update(UpdateRequest $request, Subscriber $subscriber): SubscriberResource
    {
        $data = $request->validated();

        $subscriber->fill($data);
        $subscriber->update();

        if (array_has($data, 'fields')) {
            $subscriber->fields()->detach();

            foreach (array_get($data, 'fields') as $fieldData) {
                $fieldId = Field::where('key', $fieldData['key'])->first(['id'])->id;
                $subscriber->fields()->attach($fieldId, ['value' => $fieldData['value']]);
            }
        }

        return new SubscriberResource($subscriber->load('fields'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Subscriber $subscriber
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Subscriber $subscriber): JsonResponse
    {
        $subscriber->fields()->detach();
        $subscriber->delete();

        return \Response::json([
            'success' => true,
        ]);
    }
}

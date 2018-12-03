<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Field\StoreRequest;
use App\Http\Requests\API\Field\UpdateRequest;
use App\Http\Resources\FieldResource;
use App\Models\Field;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class FieldController
 *
 * @package App\Http\Controllers\API
 * @author Dominykas Tijūnaitis (dominykas@tijunaitis.lt)
 */
class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return FieldResource::collection(Field::with('subscribers')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     *
     * @return FieldResource
     */
    public function store(StoreRequest $request): FieldResource
    {
        $field = Field::create($request->validated());

        return new FieldResource($field);
    }

    /**
     * Display the specified resource.
     *
     * @param  Field $field
     *
     * @return FieldResource
     */
    public function show(Field $field): FieldResource
    {
        return new FieldResource($field);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param  Field $field
     *
     * @return FieldResource
     */
    public function update(UpdateRequest $request, Field $field): FieldResource
    {
        $field->update($request->validated());

        return new FieldResource($field);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Field $field
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Field $field): JsonResponse
    {
        $field->subscribers()->detach();
        $field->delete();

        return \Response::json([
            'success' => true,
        ]);
    }
}

<?php

namespace App\Http\Requests\API\Field;

use App\Models\Field;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreRequest
 *
 * @package App\Http\Requests\API\Field
 * @author Dominykas Tijūnaitis (dominykas@tijunaitis.lt)
 */
class StoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                Rule::unique('fields', 'title'),
            ],
            'type'  => [
                'required',
                Rule::in(Field::TYPES),
            ],
        ];
    }
}

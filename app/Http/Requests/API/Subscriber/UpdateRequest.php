<?php

namespace App\Http\Requests\API\Subscriber;

use App\Models\Subscriber;
use App\Rules\FieldKeyExistRule;
use App\Rules\FieldValueValidRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateRequest
 *
 * @package App\Http\Requests\API\Subscriber
 * @author Dominykas Tijūnaitis (dominykas@tijunaitis.lt)
 */
class UpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'           => [],
            'state'          => [
                Rule::in(Subscriber::STATES),
            ],
            'fields.*.key'   => [
                'required_with:fields.*.value',
                new FieldKeyExistRule(),
            ],
            'fields.*.value' => [
                'required_with:fields.*.key',
                new FieldValueValidRule(),
            ],
        ];
    }
}

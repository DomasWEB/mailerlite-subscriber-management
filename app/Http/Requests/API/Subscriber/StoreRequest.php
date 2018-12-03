<?php

namespace App\Http\Requests\API\Subscriber;

use App\Rules\EmailDomainActiveRule;
use App\Rules\FieldKeyExistRule;
use App\Rules\FieldValueValidRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreRequest
 *
 * @package App\Http\Requests\API\Subscriber
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
            'email'          => [
                'required',
                'email',
                Rule::unique('subscribers', 'email'),
                new EmailDomainActiveRule(),
            ],
            'name'           => [
                'required',
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

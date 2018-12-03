<?php

namespace App\Http\Requests\API\Field;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateRequest
 *
 * @package App\Http\Requests\API\Field
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
            'title' => [
                Rule::unique('fields', 'title')->where(function (Builder $q) {
                    $q->where('id', '!=', $this->route('field')->id);
                }),
            ],
        ];
    }
}

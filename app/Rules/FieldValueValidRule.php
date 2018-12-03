<?php

namespace App\Rules;

use App\Models\Field;
use Illuminate\Contracts\Validation\Rule;

class FieldValueValidRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /** @var array $fields */
        $fields = request('fields');

        $attributeParts = explode('.', $attribute); // $attribute - fields.0.value
        $requestKey     = $attributeParts[1];

        $fieldKey = array_get($fields, sprintf('%d.key', $requestKey));
        $field    = Field::where('key', $fieldKey)->first(['type']);

        if ( ! $field) {
            // If we didn't find the field model - probably the provided key was wrong
            // so we skip the check

            return true;
        }

        return $field->validValue($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Field value is in wrong format';
    }
}

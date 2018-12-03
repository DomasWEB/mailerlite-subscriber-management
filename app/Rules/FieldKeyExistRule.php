<?php

namespace App\Rules;

use App\Models\Field;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class FieldKeyExistRule
 *
 * @package App\Rules
 * @author Dominykas Tijūnaitis (dominykas@tijunaitis.lt)
 */
class FieldKeyExistRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  string $key
     *
     * @return bool
     */
    public function passes($attribute, $key)
    {
        return Field::where('key', $key)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Provided key is not valid.';
    }
}

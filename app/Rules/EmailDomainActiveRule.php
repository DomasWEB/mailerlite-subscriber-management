<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class EmailDomainActiveRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $email
     *
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function passes($attribute, $email): bool
    {
        $domain   = substr(strrchr($email, "@"), 1);
        $cacheKey = sprintf('active_domain_%s', $domain);

        if (\Cache::has($cacheKey)) {
            return \Cache::get($cacheKey);
        }

        $minutesInADay = Carbon::MINUTES_PER_HOUR * Carbon::HOURS_PER_DAY;
        $active        = checkdnsrr(sprintf('%s.', $domain), 'ANY');

        \Cache::set($cacheKey, $active, $minutesInADay);

        return $active;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The provided email's domain is not active.";
    }
}

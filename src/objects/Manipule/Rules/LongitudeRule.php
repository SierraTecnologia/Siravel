<?php

namespace App\Http\Rules;

use App\Logic\ValueObjects\Longitude;
use Illuminate\Contracts\Validation\Rule;
use InvalidArgumentException;

/**
 * Class LongitudeRule.
 *
 * @package App\Http\Rules
 */
class LongitudeRule implements Rule
{
    /**
     * @inheritdoc
     */
    public function passes($attribute, $value)
    {
        try {
            new Longitude($value);
            return true;
        } catch (InvalidArgumentException $e) {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function message()
    {
        return __('validation.longitude');
    }
}

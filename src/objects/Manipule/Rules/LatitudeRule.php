<?php

namespace App\Http\Rules;

use App\Logic\ValueObjects\Latitude;
use Illuminate\Contracts\Validation\Rule;
use InvalidArgumentException;

/**
 * Class LatitudeRule.
 *
 * @package App\Http\Rules
 */
class LatitudeRule implements Rule
{
    /**
     * @inheritdoc
     */
    public function passes($attribute, $value)
    {
        try {
            new Latitude($value);
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
        return __('validation.latitude');
    }
}

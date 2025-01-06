<?php

namespace App\Rules;

use App\Constants\Enum;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsPatient implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value) : bool
    {
        return User::query()->where('id', $value)->where('role', Enum::PATIENT)->exists();
    }

    public function message() : string
    {
        return 'The selected doctor ID must belong to a doctor.';
    }
}

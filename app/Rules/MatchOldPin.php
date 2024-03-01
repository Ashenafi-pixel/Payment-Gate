<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MatchOldPin implements Rule
{
    protected $user;

    /**
     * Create a new rule instance.
     *
     * @param  mixed  $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value === $this->user->pin_code;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute does not match the old PIN.';
    }
}

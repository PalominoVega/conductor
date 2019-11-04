<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RucDniRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $aux=0;
        if ((!is_numeric($value) || strlen($value) !==8) &&  strlen($value) !==11){
            $aux++;
        };
        if((!is_numeric($value) || strlen($value) !==11) &&  strlen($value) !==8) {
            $aux++;
        }
        if($aux>0){
            return false;
        }        
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El DNI o RUC deben ser válidos';
    }
}

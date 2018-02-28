<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileCustonValidation implements Rule
{
    private $types, $oldFile;

    /**
     * Create a new rule instance.
     * @param Array $types tipos de extensões permitidas
     * @param String $oldFile nome antigo do arquivo (para evitar erros no update)
     * @return void
     */
    public function __construct($types, $oldFile)
    {
        $this->types = $types;
        $this->oldFile = $oldFile;
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
        if(!$value) return false;

        if ($this->oldFile == $value) return true;

        $type = explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
        if (in_array($type, $this->types))
            return true;


        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Os tipos possíveis para o campo :attribute são: '.implode(', ', $this->types);
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Collection;

class ControlThumbs implements Rule
{
    public Collection $files;
    public int $count;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Collection $files , int $count)
    {
        $this->files = $files;
        $this->count = $count;
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
        return $value == 1 ? $this->files->where('type' , 1)->count() < $this->count : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "تعداد عکس شاخص باید {$this->count} عدد باشد.";
    }
}

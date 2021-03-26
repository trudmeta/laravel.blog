<?php

namespace App\Rules;

use App\Models\Image;
use Illuminate\Contracts\Validation\Rule;

class Thumbnail implements Rule
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
     * Unique image name
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $name = null;
        if($image = request()->file('thumbnail_id')){
            $name = $image->getClientOriginalName();
        }
        return empty(Image::whereName($name)->first());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Image already exists');
    }
}

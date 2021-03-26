<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {

        $this->merge([
            'status' => $this->status == 'on'? true : false
        ]);

        $this->merge([
            'position' => !isset($this->position)? 1 : $this->position
        ]);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'unique:categories,slug,' . (optional($this->category)->id ?: 'NULL'),
            'parent_id' => 'nullable|exists:categories,id',
            'status' =>'required',
            'position' =>'required|numeric',
        ];
    }
}

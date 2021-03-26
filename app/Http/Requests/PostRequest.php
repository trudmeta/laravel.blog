<?php

namespace App\Http\Requests;
use Auth;
use App\Rules\Thumbnail;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'slug' => 'unique:posts,slug,' . (optional($this->post)->id ?: 'NULL'),
            'content' => 'required',
            'author_id' => [
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = Auth::user();
                    if(!$user->canBeAuthor()){
                        $fail($attribute.' is invalid.');
                    }
                },
            ],
            'thumbnail_id' => [
                'nullable',
                new Thumbnail,
                'image',
                'mimes:jpeg,jpg,png,gif,svg',
                'max:2000'
            ],
            'thumbnail_name' => 'nullable|exists:images,name',
            'status' =>'required',
        ];
    }
}

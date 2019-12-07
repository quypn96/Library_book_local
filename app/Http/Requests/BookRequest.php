<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'publisher_id' => 'required',
            'image' => 'image',
            'description' => 'required',
            'content' => 'required',
            'quantity' => 'required|integer',
            'author' => 'required|array|min:1',
            'author.*' => 'required',
            'categories' => 'required|array|min:1',
            'categories.*' => 'required',
        ];
    }
}

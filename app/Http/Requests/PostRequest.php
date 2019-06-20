<?php

namespace App\Http\Requests;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'level' => 'required',
            'title' => 'required|max:255',
            'content' => 'max:300'
        ];
    }

    public function messages() 
    {
        return [
            'level.required' => 'レベル項目は必須です。',
            'title.required' => 'タイトルは必須です。',
            'content.max' => '最大で300文字です。'
        ];
    }
}

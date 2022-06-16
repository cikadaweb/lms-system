<?php

namespace App\Http\Requests\Score;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'score_percentage' => 'required',
            'score_count' => 'required',
            'user_id' => 'required',
            'test_id' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'score_percentage.required' => 'Это поле надо обязательно заполнить',
            'score_count.required' => 'Это поле надо обязательно заполнить',
            'user_id.required' => 'Это поле надо обязательно заполнить',
            'test_id.required' => 'Это поле надо обязательно заполнить',
        ];

    }
}
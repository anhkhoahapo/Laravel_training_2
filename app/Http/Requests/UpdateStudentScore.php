<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentScore extends FormRequest
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
            'score' => 'required|array',
            'score.*' => 'numeric|between:0,10'
        ];
    }

    public function messages()
    {
        return [
            'score.*.numeric' => 'Score must be a number.',
            'score.*.between' => 'Score must be between 0 and 10.',
        ];
    }
}

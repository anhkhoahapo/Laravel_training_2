<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Null_;

class ClassRequest extends FormRequest
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
        if($this->request->get('teacher_id') !== Null)
            return [
                'subject_id' => 'required|exists:subjects,id',
                'teacher_id' => 'exists:teachers,id',
                'semester' => 'required|string'
            ];
        else
            return [
                'subject_id' => 'required|exists:subjects,id',
                'semester' => 'required|string'
            ];
    }
}

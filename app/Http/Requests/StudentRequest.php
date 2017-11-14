<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:40',
            'birthday' => 'required|date-format:"Y-m-d"',
            'email' => 'required|email|max:50',
            'avatar' => 'image|max:10000',
        ];

        switch ($this->method()){
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                $rules = array_add($rules, 'student_id', 'required|string|size:8|regex:/[0-9]{8}/u|unique:students');
                return $rules;
            case 'PUT':
            case 'PATCH':
                $rules = array_add($rules, 'student_id', 'required|string|size:8|regex:/[0-9]{8}/u');
                return $rules;
            default:
                break;
        }
    }
}

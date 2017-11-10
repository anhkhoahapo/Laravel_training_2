<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacher extends FormRequest
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
            'msgv' => 'required|string|size:8|regex:/[0-9]{8}/u',
            'name' => 'required|string|max:40',
            'birthday' => 'required|date-format:"Y-m-d"',
            'email' => 'required|email|max:50',
            'avatar' => 'image|max:10000',
        ];
    }
}

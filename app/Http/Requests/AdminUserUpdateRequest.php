<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUserUpdateRequest extends FormRequest
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
            'name'=>'required|string|max:191',
//            'telephone' => 'required|string|regex:/(8)[0-9]{10}/|max:11|unique:users',
            'telephone'=>[
                'required',
                'string',
                'regex:/(8)[0-9]{10}/',
                'max:11',
                Rule::unique('users')->ignore($this->route('user')),
            ],
            'email'=>[
                'required',
                'string',
                'regex:/(.+)@(.+)\.(.+)/i',
                'max:191',
                Rule::unique('users')->ignore($this->route('user')),
            ],
            'money'=>'required|numeric',
            'percent'=>'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'money.numeric'=>'Значение баланса должно быть написано через точку или быть целым числом.',
        ];
    }
}

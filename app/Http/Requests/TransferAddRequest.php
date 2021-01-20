<?php

namespace App\Http\Requests;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;

class TransferAddRequest extends FormRequest
{
    private $data;
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
        $this->data=\Illuminate\Http\Request::all();
        if($this->data['type']=='sop'){
            return [
                'whom'=>'string|regex:/(8)[0-9]{10}/|min:11|max:11',
            ];
        }
        else
            {
                return [
                    'whom'=>'string|min:16|max:16',
                ];
            }
    }

    public function messages()
    {
        if($this->data['type']=='sop') {
            return [
                'whom.regex' => 'Поле c номером для перевода имеет не верный формат',
                'whom.min' => 'Количество символов номера телефона должно быть не меньше :min.',
                'whom.max' => 'Количество символов номера телефона не может превышать :max.',
            ];
        }
        else {
            return [
                'whom.min' => 'Количество символов номера карты должно быть не меньше :min.',
                'whom.max' => 'Количество символов номера карты не может превышать :max.',
            ];
        }
    }
}

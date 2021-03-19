<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $id = $this->request->get('user_id');

        return  [
            'name'=> 'required',
            'email'=> 'required|email|unique:users'. ',id,' . $id,
            'password'=> 'nullable|min:8',
            'password_confirmation'=> 'same:password'
        ];
    }
}

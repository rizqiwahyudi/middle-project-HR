<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username'      => 'required|string|max:255|unique:users,username,'. $this->user->id,
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'telepon'       => 'required|numeric|digits_between:10,13|unique:users,telepon,'. $this->user->id,
            'email'         => 'required|string|email|max:255|unique:users,email,'. $this->user->id,
            'company'       => 'required|not_in:0',
            'department'    => 'required|not_in:0',
            'role'          => 'required|not_in:0',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'name'        => 'required|string|max:255',
            'email'       => 'required|string|email|max:255|unique:companies,email,'. $this->company->id,
            'logo'        => 'image|mimes:jpeg,jpg,png,svg|max:2048|dimensions:min_width=100,min_height=100',
            'website_url' => 'required|url|unique:companies,website_url,'. $this->company->id,
        ];
    }
}

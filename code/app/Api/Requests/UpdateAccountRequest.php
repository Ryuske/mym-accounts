<?php

namespace App\Api\Requests;

use Illuminate\Support\Facades\Input;

class UpdateAccountRequest extends Request
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
            'account'           => 'account_structure|required',
            'account.last_name' => 'max:30',
            'account.email'     => "email|unique:users,email,{$this->route('id')}|max:254",
            'account.password'  => 'confirmed|min:4'
        ];
    }
}

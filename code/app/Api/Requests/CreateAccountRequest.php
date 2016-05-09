<?php

namespace App\Api\Requests;

use Illuminate\Support\Facades\Input;

class CreateAccountRequest extends Request
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
            'account'           => 'required|account_structure',
            'account.last_name' => 'required|max:30',
            'account.email'     => "required|email|unique:users,email,{$this->route('id')}|max:254",
            'account.password'  => 'required|confirmed|min:4'
        ];
    }
}

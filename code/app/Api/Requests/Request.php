<?php

namespace App\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Dingo\Api\Exception\ValidationHttpException;

abstract class Request extends FormRequest
{

    protected function failedValidation(Validator $validator) {
        throw new ValidationHttpException($validator->errors());
    }
}

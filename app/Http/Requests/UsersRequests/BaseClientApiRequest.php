<?php

namespace App\Http\Requests\ClientRequests;

use Exception;
use App\Exceptions\ClientApiValidationException;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class BaseClientApiRequest extends FormRequest implements ValidatesWhenResolved
{
    /**
     * 重写框架的 FormRequest 类的 failedValidation 方法
     * @param Validator $validator
     * @throws SfoException
     */
    protected function failedValidation(Validator $validator)
    {

        throw (new ClientApiValidationException($validator))
            ->errorBag($this->errorBag);
    }
}
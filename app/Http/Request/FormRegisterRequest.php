<?php

namespace App\Http\Request;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class FormRegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:45',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = [
            'message' => 'Fail.',
            'validate' => $validator->errors()
        ];

        throw new HttpResponseException(
            response()->json($response, JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
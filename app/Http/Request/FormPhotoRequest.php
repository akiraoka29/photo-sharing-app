<?php

namespace App\Http\Request;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

use App\Enum\Message;

class FormPhotoRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() !== null;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:45',
            'caption' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    protected function failedAuthorization()
    {
        $response = [
            'message' => Message::UNAUTHORIZED,
        ];

        throw new HttpResponseException(
            response()->json($response, JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
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
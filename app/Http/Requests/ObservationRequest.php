<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ObservationRequest extends FormRequest
{
    /**
     * Запрос могут делать все пользователи.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
        ];
    }

    /*
     * Переопределение базового поведения (отправка redirect-ответа)
     * на отправку соответствующего json-а.
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException($validator, response()->json([
            'status' => 'error',
            'message' => 'Invalid query parameters.',
            'errors' => $validator->errors()
        ], 400));
    }

}

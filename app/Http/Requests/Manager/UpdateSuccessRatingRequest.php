<?php

namespace App\Http\Requests\Manager;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSuccessRatingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'schoolID' => 'sometimes|integer|exists:schools,id',
            'gradeID' => 'sometimes|integer|exists:grades,id',
            'total_students' => 'sometimes|integer|min:0',
            'A' => 'sometimes|integer|min:0',
            'B' => 'sometimes|integer|min:0',
            'C' => 'sometimes|integer|min:0',
            'D' => 'sometimes|integer|min:0',
            'F' => 'sometimes|integer|min:0',
        ];
    }
}

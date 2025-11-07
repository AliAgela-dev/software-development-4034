<?php

namespace App\Http\Requests\Manager;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuccessRatingRequest extends FormRequest
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
            'schoolID' => 'required|integer|exists:schools,id',
            'gradeID' => 'required|integer|exists:grades,id',
            'total_students' => 'required|integer|min:0',
            'A' => 'required|integer|min:0',
            'B' => 'required|integer|min:0',
            'C' => 'required|integer|min:0',
            'D' => 'required|integer|min:0',
            'F' => 'required|integer|min:0',
        ];
    }
}

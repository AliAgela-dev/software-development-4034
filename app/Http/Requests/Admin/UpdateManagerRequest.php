<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManagerRequest extends FormRequest
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
        $managerId = $this->route('manager');
        return [
            'name' => 'sometimes|string|max:255',
            'username' => 'sometimes|string|max:255|unique:managers,username,' . $managerId,
            'phone_number' => 'sometimes|string|max:20|unique:managers,phone_number,' . $managerId,
            'password' => 'sometimes|string|min:8',
            'schoolID' => 'sometimes|integer',
        ];
    }
}

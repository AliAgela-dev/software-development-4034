<?php

namespace App\Http\Requests\Admin\Manager;

use App\Models\Manager;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $manager = $this->route('manager');
        $managerId = $manager instanceof Manager ? $manager->getKey() : $manager;

        return [
            'name' => 'sometimes|string|max:255',
            'username' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('managers', 'username')->ignore($managerId),
            ],
            'phone_number' => [
                'sometimes',
                'string',
                'max:20',
                Rule::unique('managers', 'phone_number')->ignore($managerId),
            ],
            'password' => 'sometimes|string|min:8',
            'schoolID' => 'sometimes|integer',
        ];
    }
}

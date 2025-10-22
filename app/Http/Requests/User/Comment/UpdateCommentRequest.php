<?php

namespace App\Http\Requests\User\Comment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
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
            'schoolID' => 'sometimes|exists:schools,id',
            'userID' => 'sometimes|exists:users,id',
            'comment' => 'sometimes|string',
        ];
    }
}

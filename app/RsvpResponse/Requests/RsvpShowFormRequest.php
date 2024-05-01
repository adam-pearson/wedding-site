<?php

namespace App\RsvpResponse\Requests;

use App\RsvpResponse\DTOs\RsvpSubmissionDto;
use Illuminate\Foundation\Http\FormRequest;

class RsvpShowFormRequest extends FormRequest
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
            'code' => 'required|exists:guests,unique_code',
        ];
    }

    public function getCode(): string
    {
        return $this->input('code');
    }
}
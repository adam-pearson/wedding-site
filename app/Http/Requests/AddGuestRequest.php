<?php

namespace App\Http\Requests;

use App\DTOs\AddGuestRequestDto;
use App\Enums\GuestType;
use App\Services\GuestService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddGuestRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'email|nullable',
            'phone' => 'min_digits:7|max_digits:15|nullable',
            'address' => 'string|nullable',
            'plus_one_allowed' => 'boolean',
            'guest_type' => ['required', Rule::enum(GuestType::class)],
        ];
    }

    public function getDto(): AddGuestRequestDto
    {
        return new AddGuestRequestDto(
            name: $this->input('name'),
            plusOneAllowed: $this->input('plus_one_allowed'),
            guestType: GuestType::from($this->input('guest_type')),
            email: $this->input('email'),
            phone: $this->input('phone'),
            address: $this->input('address'),
        );
    }
}

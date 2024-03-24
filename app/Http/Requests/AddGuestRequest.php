<?php

namespace App\Http\Requests;

use App\DTOs\AddGuestRequestDto;
use App\Enums\GuestType;
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
            'phone' => 'min:7|max:15|nullable',
            'address' => 'string|nullable',
            'plus_one_allowed' => 'boolean',
            'is_child' => 'boolean',
            'guest_type' => ['required', Rule::enum(GuestType::class)],
            'plus_one_of' => 'integer|nullable|sometimes',
            'coming' => 'boolean|nullable|sometimes',
            'alcohol' => 'boolean|nullable|sometimes',
            'dietary_requirements' => 'string|nullable|sometimes',
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
            isChild: $this->input('is_child'),
            plusOneOf: $this->input('plus_one_of'),
            coming: $this->input('coming'),
            alcohol: $this->input('alcohol'),
            dietaryRequirements: $this->input('dietary_requirements'),
        );
    }
}
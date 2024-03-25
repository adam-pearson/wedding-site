<?php

namespace App\RsvpResponse\Requests;

use App\Guest\DTOs\GuestContactDetailsDto;
use App\Guest\DTOs\GuestDto;
use App\Guest\Enums\GuestType;
use App\RsvpResponse\DTOs\RsvpResponseDto;
use Illuminate\Foundation\Http\FormRequest;

class RsvpResponseSubmissionRequest extends FormRequest
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
            'email' => 'email|nullable',
            'phone' => 'min:7|max:15|nullable',
            'address' => 'string|nullable',
            'using_plus_one' => 'boolean|required|sometimes',
            'coming' => 'boolean|required',
            'alcohol' => 'boolean|nullable|sometimes',
            'dietary_requirements' => 'string|nullable',
            'plus_one_name' => 'string|nullable',
            'plus_one_alcohol' => 'boolean|nullable|sometimes',
            'plus_one_dietary_requirements' => 'string|nullable',
        ];
    }

    public function getRsvpDto(): RsvpResponseDto
    {
        return new RsvpResponseDto(
            guestId: $this->query('id'),
            coming: $this->input('coming'),
            alcohol: $this->input('alcohol'),
            dietaryRequirements: $this->input('dietary_requirements'),
            usingPlusOne: $this->input('using_plus_one'),
        );
    }

    public function getGuestContactDetailsDto(): GuestContactDetailsDto
    {
        return new GuestContactDetailsDto(
            id: $this->guest->id,
            name: $this->input('name'),
            email: $this->input('email'),
            phone: $this->input('phone'),
            address: $this->input('address'),
        );
    }

    public function getPlusOneGuestDto(): GuestDto
    {
        return new GuestDto(
            plusOneOf: $this->route('id'),
            name: $this->input('plus_one_name'),
            guestType: GuestType::from($this->guest->guest_type),
            plusOneAllowed: false,
            isChild: false,
        );
    }

    public function getPlusOneRsvpDto(int $plusOneId): RsvpResponseDto
    {
        return new RsvpResponseDto(
            guestId: $plusOneId,
            coming: $this->input('coming'),
            alcohol: $this->input('plus_one_alcohol'),
            dietaryRequirements: $this->input('plus_one_dietary_requirements'),
            usingPlusOne: false,
        );
    }
}
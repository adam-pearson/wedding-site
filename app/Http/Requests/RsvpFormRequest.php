<?php

namespace App\Http\Requests;

use App\DTOs\EditGuestRequestDto;
use App\DTOs\GuestContactDetailsDto;
use App\DTOs\RsvpSubmissionDto;
use App\Enums\GuestType;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use App\Models\Guest;

class RsvpFormRequest extends FormRequest
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
            'coming' => 'boolean|required',
            'email' => 'email|nullable',
            'phone' => 'min_digits:7|max_digits:15|nullable',
            'alcohol' => 'sometimes|boolean|required',
            'using_plus_one' => 'sometimes|boolean|required',
            'dietary_requirements' => 'string|nullable',
            'plus_one_name' => 'sometimes|string|nullable',
            'plus_one_alcohol' => 'sometimes|boolean|nullable',
            'plus_one_dietary_requirements' => 'sometimes|string|nullable',
        ];
    }

    public function getDto(): RsvpSubmissionDto
    {
        return new RsvpSubmissionDto(
            guestId: $this->route('guest')->id,
            usingPlusOne: $this->input('using_plus_one'),
            email: $this->input('email'),
            phone: $this->input('phone'),
            coming: $this->input('coming'),
            alcohol: $this->input('alcohol'),
            dietaryRequirements: $this->input('dietary_requirements'),
            plusOneName: $this->input('plus_one_name'),
            plusOneAlcohol: $this->input('plus_one_alcohol'),
            plusOneDietaryRequirements: $this->input('plus_one_dietary_requirements'),
        );
    }

    public function getContactDetailsDto(): GuestContactDetailsDto
    {
        return new GuestContactDetailsDto(
            guestId: $this->route('guest')->id,
            email: $this->input('email'),
            phone: $this->input('phone'),
            address: $this->route('guest')->address,
        );
    }
}

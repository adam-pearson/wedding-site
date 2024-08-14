<?php

namespace App\RsvpResponse\Requests;

use App\Guest\DTOs\GuestContactDetailsDto;
use App\Guest\DTOs\GuestDto;
use App\Guest\Enums\GuestType;
use App\RsvpResponse\DTOs\RsvpSubmissionDto;
use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'coming' => 'boolean|required',
            'email' => 'email|required|sometimes',
            'phone' => 'min:7|max:15|required|sometimes',
            'alcohol' => 'boolean|required|sometimes',
            'dietary_requirements' => 'string|nullable',
            'song_requests' => 'string|nullable',
            'hated_songs' => 'string|nullable',
            'bringing_plus_one' => 'boolean|required|sometimes',
            'plus_one_name' => 'string|required|sometimes',
            'plus_one_alcohol' => 'boolean|required|sometimes',
            'plus_one_dietary_requirements' => 'string|nullable|sometimes',
        ];
    }

    public function getRsvpDto(): RsvpSubmissionDto
    {
        return new RsvpSubmissionDto(
            coming: $this->input('coming') ?? false,
            guestId: $this->route('guest')->id,
            bringingPlusOne: $this->input('bringing_plus_one') ?? false,
            alcohol: $this->input('alcohol'),
            dietaryRequirements: $this->input('dietary_requirements'),
            songRequests: $this->input('song_requests'),
            hatedSongs: $this->input('hated_songs'),
        );
    }

    public function getGuestContactDetailsDto(): GuestContactDetailsDto
    {
        return new GuestContactDetailsDto(
            id: $this->route('guest')->id,
            name: $this->route('guest')->name,
            email: $this->input('email'),
            phone: $this->input('phone'),
        );
    }

    public function getPlusOneGuestDto(): GuestDto
    {
        return new GuestDto(
            name: $this->input('plus_one_name'),
            plusOneAllowed: false,
            guestType: GuestType::from($this->route('guest')->guest_type),
            isChild: false,
            plusOneOf: $this->route('guest')->id,
        );
    }

    public function getPlusOneRsvpDto(int $plusOneId): RsvpSubmissionDto
    {
        return new RsvpSubmissionDto(
            guestId: $plusOneId,
            coming: $this->input('coming'),
            alcohol: $this->input('plus_one_alcohol'),
            dietaryRequirements: $this->input('plus_one_dietary_requirements'),
            bringingPlusOne: false,
        );
    }
}

<?php

namespace App\Guest\Requests;

use App\Guest\DTOs\GuestDto;
use App\Guest\Enums\GuestType;
use App\RsvpResponse\DTOs\RsvpSubmissionDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class UpdateGuestRequest extends FormRequest
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
            'is_child' => 'boolean',
            'guest_type' => ['required', Rule::enum(GuestType::class)],
            'coming' => 'boolean|nullable',
            'alcohol' => 'boolean|nullable',
            'dietary_requirements' => 'string|nullable',
            'invite_sent_on' => 'date|nullable',
            'coming' => 'boolean|nullable',
            'alcohol' => 'boolean|nullable',
            'dietary_requirements' => 'string|nullable',
        ];
    }

    public function getGuestDto(): GuestDto
    {
        return new GuestDto(
            id: $this->guest->id,
            name: $this->input('name'),
            plusOneAllowed: $this->input('plus_one_allowed') ?? false,
            plusOneOf: $this->guest->plusOneOwner?->id,
            guestType: GuestType::from($this->input('guest_type') ?? $this->guest->plusOneOwner->guest_type),
            email: $this->input('email'),
            phone: $this->input('phone'),
            address: $this->input('address'),
            isChild: $this->input('is_child') ?? $this->guest->plusOneOwner->is_child,
            inviteSentOn: $this->input('invite_sent_on') ? Carbon::parse($this->input('invite_sent_on')) : null,
        );
    }

    public function getRsvpDto(): ?RsvpSubmissionDto
    {
        if ($this->input('coming') === null) {
            return null;
        }

        return new RsvpSubmissionDto(
            guestId: $this->guest->id,
            coming: $this->guest->plusOneOwner?->rsvpResponse?->coming ?? $this->input('coming'),
            alcohol: $this->input('alcohol') ?? false,
            dietaryRequirements: $this->input('dietary_requirements'),
        );
    }

    public function getId(): int
    {
        return request()->route('guest');
    }
}

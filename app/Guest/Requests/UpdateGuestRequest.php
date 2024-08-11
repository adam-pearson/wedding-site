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
            'group.id' => 'int|nullable',
            'group.group_name' => 'string|sometimes|required_with:group.id',
            'group_members' => 'array|nullable|required_with:group.id',
            'coming' => 'boolean|nullable',
            'alcohol' => 'boolean|nullable',
            'dietary_requirements' => 'string|nullable',
            'invite_sent_on' => 'date|nullable',
            'save_the_date_sent_on' => 'date|nullable',
            'song_request' => 'string|nullable',
            'rsvp_on_behalf_of' => 'array|nullable',
            'rsvp_for' => 'array|nullable',
        ];
    }

    public function getGuestDto(): GuestDto
    {
        return new GuestDto(
            name: $this->input('name'),
            plusOneAllowed: $this->input('plus_one_allowed') ?? false,
            guestType: GuestType::from($this->input('guest_type') ?? $this->route('guest')->plusOneOwner->guest_type),
            isChild: $this->input('is_child') ?? $this->route('guest')->plusOneOwner->is_child,
            groupId: $this->input('group.id'),
            groupName: $this->input('group.group_name'),
            groupMembers: $this->input('group_members'),
            email: $this->input('email'),
            phone: $this->input('phone'),
            address: $this->input('address'),
            plusOneOf: $this->route('guest')->plusOneOwner?->id,
            id: $this->route('guest')->id,
            inviteSentOn: $this->input('invite_sent_on') ? Carbon::parse($this->input('invite_sent_on')) : null,
            saveTheDateSentOn: $this->input('save_the_date_sent_on') ? Carbon::parse($this->input('save_the_date_sent_on')) : null,
            rsvpOnBehalfOf: $this->input('rsvp_on_behalf_of'),
            rsvpFor: $this->input('rsvp_for'),
        );
    }

    public function getRsvpDto(): ?RsvpSubmissionDto
    {
        if ($this->input('coming') === null) {
            return null;
        }

        return new RsvpSubmissionDto(
            coming: $this->route('guest')->plusOneOwner?->rsvpResponse?->coming ?? $this->input('coming'),
            guestId: $this->route('guest')->id,
            alcohol: $this->input('alcohol') ?? false,
            dietaryRequirements: $this->input('dietary_requirements'),
            songRequest: $this->input('song_request'),
        );
    }

    public function getId(): int
    {
        return request()->route('guest');
    }
}

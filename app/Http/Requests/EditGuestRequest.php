<?php

namespace App\Http\Requests;

use App\DTOs\EditGuestRequestDto;
use App\Enums\GuestType;
use App\Repositories\GuestRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class EditGuestRequest extends FormRequest
{

    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

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
        ];
    }

    public function getDto(): EditGuestRequestDto
    {
        $guest = $this->guestRepository->find($this->query('id'), ['receivedInvite', 'plusOneParent.receivedInvite']);

        return new EditGuestRequestDto(
            id: $this->query('id'),
            name: $this->input('name'),
            plusOneAllowed: $this->input('plus_one_allowed') ?? false,
            guestType: GuestType::from($this->input('guest_type') ?? $guest->plusOneParent->guest_type),
            email: $this->input('email'),
            phone: $this->input('phone'),
            address: $this->input('address'),
            isChild: $this->input('is_child') ?? $guest->plusOneParent->is_child,
            coming: $this->input('coming') ?? $guest->plusOneParent->receivedInvite->coming,
            alcohol: $this->input('alcohol') ?? false,
            dietaryRequirements: $this->input('dietary_requirements'),
            inviteSentOn: $this->input('invite_sent_on') ? Carbon::parse($this->input('invite_sent_on')) : null,
        );
    }
}

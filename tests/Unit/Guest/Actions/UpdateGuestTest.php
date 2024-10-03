<?php

namespace Guest\Actions;

use App\Guest\Actions\UpdateGuest;
use App\Guest\DTOs\GuestDto;
use App\Guest\Enums\GuestType;
use App\Guest\Models\Guest;
use App\RsvpResponse\DTOs\RsvpSubmissionDto;
use App\RsvpResponse\Models\RsvpResponse;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UpdateGuestTest extends TestCase
{
    use DatabaseTransactions;

    private UpdateGuest $updateGuest;

    /**
     * A basic test example.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->updateGuest = app(UpdateGuest::class);
    }

    public function testUpdatesSingleGuestType(): void
    {
        $guest = Guest::factory()
            ->create([
                'name' => 'John Doe',
                'plus_one_allowed' => false,
                'is_child' => false,
                'guest_type' => GuestType::ALL_DAY->value,
            ]);

        $guestDto = new GuestDto(
            id: $guest->id,
            name: $guest->name,
            plusOneAllowed: $guest->plus_one_allowed,
            isChild: $guest->is_child,
            guestType: GuestType::tryFrom('evening'),
        );

        $this->updateGuest->execute($guestDto);

        $this->assertDatabaseHas('guests', [
            'id' => $guest->id,
            'guest_type' => GuestType::EVENING->value,
        ]);
    }

    public function testUpdatesSingleGuestMultipleColumns(): void
    {
        $guest = Guest::factory()
            ->create([
                'name' => 'John Doe',
                'email' => 'test@test.com',
                'phone' => '123456789',
                'plus_one_allowed' => false,
                'is_child' => false,
                'guest_type' => GuestType::ALL_DAY->value,
            ]);

        $guestDto = new GuestDto(
            id: $guest->id,
            name: 'John Smith',
            email: 'updatedTest@test.com',
            phone: '987654321',
            plusOneAllowed: $guest->plus_one_allowed,
            isChild: $guest->is_child,
            guestType: GuestType::tryFrom('evening'),
        );

        $this->updateGuest->execute($guestDto);

        $this->assertDatabaseHas('guests', [
            'id' => $guest->id,
            'name' => 'John Smith',
            'guest_type' => GuestType::EVENING->value,
            'email' => 'updatedTest@test.com',
            'phone' => '987654321',
        ]);
    }

    public function testUpdatesSingleGuestRsvpResponse(): void
    {
        $guest = Guest::factory()
            ->create([
                'name' => 'John Doe',
                'email' => 'test@test.com',
                'phone' => '123456789',
                'plus_one_allowed' => false,
                'is_child' => false,
                'guest_type' => GuestType::ALL_DAY->value,
            ]);

        $rsvpResponse = RsvpResponse::factory()
            ->create([
                'guest_id' => $guest->id,
                'coming' => true,
                'dietary_requirements' => 'None',
            ]);

        $guestDto = new GuestDto(
            id: $guest->id,
            name: $guest->name,
            email: $guest->email,
            phone: $guest->phone,
            plusOneAllowed: $guest->plus_one_allowed,
            isChild: $guest->is_child,
            guestType: GuestType::tryFrom($guest->guest_type),
        );

        $rsvpResponseDto = new RsvpSubmissionDto(
            guestId: $rsvpResponse->guest_id,
            coming: true,
            dietaryRequirements: 'Vegan',
        );

        $this->updateGuest->execute($guestDto, $rsvpResponseDto);

        $this->assertDatabaseHas('guests', [
            'id' => $guest->id,
            'name' => 'John Doe',
            'guest_type' => GuestType::ALL_DAY->value,
            'email' => 'test@test.com',
            'phone' => '123456789',
        ]);

        $this->assertDatabaseHas('rsvp_responses', [
            'id' => $rsvpResponse->id,
            'guest_id' => $guest->id,
            'coming' => true,
            'dietary_requirements' => 'Vegan',
        ]);
    }

    public function testUpdatesSingleGuestRsvpResponseAndGuestDetails(): void
    {
        $guest = Guest::factory()
            ->create([
                'name' => 'John Doe',
                'email' => 'test@test.com',
                'phone' => '123456789',
                'plus_one_allowed' => false,
                'is_child' => false,
                'guest_type' => GuestType::ALL_DAY->value,
            ]);

        $rsvpResponse = RsvpResponse::factory()
            ->create([
                'guest_id' => $guest->id,
                'coming' => true,
                'dietary_requirements' => 'None',
            ]);

        $guestDto = new GuestDto(
            id: $guest->id,
            name: 'John Smith',
            email: 'testTESTTESTTEST@test.com',
            phone: '987654321',
            plusOneAllowed: $guest->plus_one_allowed,
            isChild: $guest->is_child,
            guestType: GuestType::EVENING,
        );

        $rsvpResponseDto = new RsvpSubmissionDto(
            guestId: $rsvpResponse->guest_id,
            coming: true,
            dietaryRequirements: 'Vegan',
        );

        $this->updateGuest->execute($guestDto, $rsvpResponseDto);

        $this->assertDatabaseHas('guests', [
            'id' => $guest->id,
            'name' => 'John Smith',
            'guest_type' => GuestType::EVENING->value,
            'email' => 'testTESTTESTTEST@test.com',
            'phone' => '987654321',
        ]);

        $this->assertDatabaseHas('rsvp_responses', [
            'id' => $rsvpResponse->id,
            'guest_id' => $guest->id,
            'coming' => true,
            'dietary_requirements' => 'Vegan',
        ]);
    }

    public function testRemovingPlusOneAllowedDeletesPlusOneAndRsvp(): void
    {
        $guest = Guest::factory()
            ->create([
                'name' => 'John Doe',
                'email' => 'test@test.com',
                'phone' => '123456789',
                'plus_one_allowed' => true,
                'is_child' => false,
                'guest_type' => GuestType::ALL_DAY->value,
            ]);

        $rsvpResponse = RsvpResponse::factory()
            ->create([
                'guest_id' => $guest->id,
                'coming' => true,
                'dietary_requirements' => 'None',
            ]);

        $plusOne = Guest::factory()
            ->create([
                'name' => 'John Doe + 1',
                'email' => 'test@test.com + 1',
                'phone' => '123456789 + 1',
                'plus_one_allowed' => false,
                'plus_one_of' => $guest->id,
                'is_child' => false,
                'guest_type' => GuestType::ALL_DAY->value,
            ]);

        $plusOneRsvp = RsvpResponse::factory()
            ->create([
                'guest_id' => $plusOne->id,
                'coming' => true,
                'dietary_requirements' => 'None',
            ]);

        $guestDto = new GuestDto(
            id: $guest->id,
            name: 'John Doe',
            email: 'test@test.com',
            phone: '123456789',
            plusOneAllowed: false,
            isChild: $guest->is_child,
            guestType: GuestType::EVENING,
        );

        $rsvpResponseDto = new RsvpSubmissionDto(
            guestId: $rsvpResponse->guest_id,
            coming: true,
            dietaryRequirements: 'Vegan',
        );

        $this->updateGuest->execute($guestDto, $rsvpResponseDto);

        $this->assertDatabaseHas('guests', [
            'id' => $guest->id,
            'name' => 'John Doe',
            'guest_type' => GuestType::EVENING->value,
            'plus_one_allowed' => false,
            'email' => 'test@test.com',
            'phone' => '123456789',
        ]);

        $this->assertDatabaseHas('rsvp_responses', [
            'id' => $rsvpResponse->id,
            'guest_id' => $guest->id,
            'coming' => true,
            'dietary_requirements' => 'Vegan',
        ]);

        $this->assertSoftDeleted('guests', [
            'id' => $plusOne->id
        ]);

        $this->assertSoftDeleted('rsvp_responses', [
            'id' => $plusOneRsvp->id
        ]);
    }
}

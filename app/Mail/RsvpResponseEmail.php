<?php

namespace App\Mail;

use App\Guest\DTOs\GuestContactDetailsDto;
use App\Guest\DTOs\GuestDto;
use App\RsvpResponse\DTOs\RsvpSubmissionDto;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RsvpResponseEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly GuestDto $guestDto,
        private readonly RsvpSubmissionDto $rsvpDto,
        private readonly ?GuestDto $plusOneGuestDto = null,
        private readonly ?RsvpSubmissionDto $plusOneRsvpDto = null,
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rsvp Response Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.rsvp.rsvp_response',
            with: [
                'guest' => $this->guestDto,
                'rsvp' => $this->rsvpDto,
                'plusOne' => $this->plusOneGuestDto,
                'plusOneRsvp' => $this->plusOneRsvpDto,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

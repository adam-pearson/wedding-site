<?php

namespace App\RsvpResponse\Jobs;

use App\Guest\DTOs\GuestDto;
use App\Mail\RsvpResponseEmail;
use App\RsvpResponse\DTOs\RsvpSubmissionDto;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Psr\Log\LoggerInterface;

class SendRsvpNotificationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $tries = 3;

    private Mailer $mailer;

    private LoggerInterface $logger;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly GuestDto           $guestDto,
                                private readonly RsvpSubmissionDto  $rsvpDto,
                                private readonly ?GuestDto          $plusOneGuestDto = null,
                                private readonly ?RsvpSubmissionDto $plusOneRsvpDto = null)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(LoggerInterface $logger, Mailer $mailer): void
    {
        try {
            $mailer->to(config('mail.from.address'))->send(new RsvpResponseEmail(
                guestDto: $this->guestDto,
                rsvpDto: $this->rsvpDto,
                plusOneGuestDto: $this->plusOneGuestDto ?? null,
                plusOneRsvpDto: $this->plusOneRsvpDto ?? null
            ));
            $logger->info('RSVP submitted successfully and email sent for guest ' . $this->guestDto->name . ' with id ' . $this->guestDto->id);
        } catch (Exception $e) {
            $logger->error('RSVP submitted successfully but email failed to send', ['exception' => $e->getMessage()]);
        }
    }
}

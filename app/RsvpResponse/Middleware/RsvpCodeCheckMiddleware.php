<?php

namespace App\RsvpResponse\Middleware;

use App\Repositories\GuestRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RsvpCodeCheckMiddleware
{
    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $code = $request?->code;

        $codeExists = $code && $this->guestRepository->codeExists(strtoupper($code));

        if (!$codeExists) {
            return redirect()
                ->route('guest.rsvp.code')
                ->withErrors(['Invalid code']);
        }

        $guest = $this->guestRepository->getGuestByCode(strtoupper($code));
        $inviteAlreadyReceived = $guest->rsvpResponse()->exists();

        if ($inviteAlreadyReceived) {
            return redirect()
                ->route('guest.rsvp.code')
                ->withErrors(['Code has already been used. If you think this is an error, or want to amend your details, please contact Adam or Heather.']);
        }
        return $next($request);
    }
}

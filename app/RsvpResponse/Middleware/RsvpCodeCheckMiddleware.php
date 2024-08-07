<?php

namespace App\RsvpResponse\Middleware;

use App\Guest\Repositories\GuestRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

readonly class RsvpCodeCheckMiddleware
{
    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $code = $request->code;

        $codeExists = $code && $this->guestRepository->codeExists(strtoupper($code));

        if (!$codeExists) {
            return redirect()
                ->route('guest.rsvp.code')
                ->withErrors(['Invalid code']);
        }

        $guest = $this->guestRepository->getGuestByCode(strtoupper($code));
        $inviteAlreadyReceived = $guest->rsvpResponse()->exists();

        if ($inviteAlreadyReceived) {
            return redirect()->route('guest.rsvp.success', ['code' => $code]);
        }

        return $next($request);
    }
}

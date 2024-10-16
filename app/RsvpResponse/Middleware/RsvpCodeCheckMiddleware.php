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
                ->withErrors(['The code you entered is invalid. Please try again.']);
        }

        return $next($request);
    }
}

<?php

namespace App\RsvpResponse\Middleware;

use App\RsvpResponse\Models\RsvpResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RsvpRepeatedSubmissionCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guest = $request?->guest;

        $guestAlreadySubmitted = $guest && RsvpResponse::where('guest_id', $guest->id)->exists();

        if ($guestAlreadySubmitted) {
            return redirect()
                ->back()
                ->withErrors(['You have already submitted your RSVP. If you think this is an error, or want to amend your details, please contact Adam or Heather.']);
        }

        return $next($request);
    }
}
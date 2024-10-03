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
            return response()->json(['success' => false, 'message' => 'RSVP already submitted'], 400);
        }

        return $next($request);
    }
}

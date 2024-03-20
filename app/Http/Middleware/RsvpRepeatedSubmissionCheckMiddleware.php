<?php

namespace App\Http\Middleware;

use App\Models\ReceivedInvite;
use App\Repositories\GuestRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RsvpRepeatedSubmissionCheckMiddleware
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
        $guest = $request?->guest;

        $guestAlreadySubmitted = $guest && ReceivedInvite::where('guest_id', $guest->id)->exists();

        if ($guestAlreadySubmitted) {
            return redirect()->back()->withErrors(['You have already submitted your RSVP. If you think this is an error, or want to amend your details, please contact Adam or Heather.']);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

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

        if ($code && !$this->guestRepository->codeExists($code)) {
            return redirect()
                ->route('guest.rsvp')
                ->withErrors(['code' => 'Invalid code']);
        }

        return $next($request);
    }
}

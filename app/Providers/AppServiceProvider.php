<?php

namespace App\Providers;

use App\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Laravel\Pennant\Feature;
use Laravel\Pennant\Middleware\EnsureFeaturesAreActive;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        EnsureFeaturesAreActive::whenInactive(
            function (Request $request, array $features) {
                return redirect()->route('home');
            }
        );

        Feature::resolveScopeUsing(fn ($driver) => null);

        Feature::define('user-registration', fn (): bool => config('features.user_registration.enabled'));
    }
}

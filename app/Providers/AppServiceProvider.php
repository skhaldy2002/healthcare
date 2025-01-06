<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

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
        view()->share('settings', Setting::query()->get());
//        View::composer('*', function ($view) {
//            if (Auth::check()) {
//                $user = Auth::user();
//                $notifications = $user->unreadNotifications()->paginate(10);
//                $notifications = NotificationResource::collection($notifications)->resolve();
//                $view->with('notifications', $notifications);
//            }
//        });
    }
}

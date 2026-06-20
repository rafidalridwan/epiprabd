<?php

namespace App\Providers;

use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        try {
            if (Schema::hasTable('settings')) {
                View::share('settings', Setting::allCached());
            } else {
                View::share('settings', []);
            }
        } catch (\Throwable) {
            View::share('settings', []);
        }

        View::composer('admin.*', function ($view) {
            try {
                if (Schema::hasTable('contact_messages')) {
                    $view->with('unreadMessages', ContactMessage::where('is_read', false)->count());
                } else {
                    $view->with('unreadMessages', 0);
                }
            } catch (\Throwable) {
                $view->with('unreadMessages', 0);
            }
        });
    }
}

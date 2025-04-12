<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share the current user with all views
        View::composer('*', function ($view) {
            // Get the current route parameter if it exists
            $id = request()->route('id');
            
            if ($id) {
                $user = User::with('plan')->find($id);
                $view->with('user', $user);
            }
        });
    }
}
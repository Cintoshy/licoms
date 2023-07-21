<?php

// app/Providers/ViewComposerServiceProvider.php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Using a view composer to bind $user to all views
        view()->composer('*', function ($view) {
            $user = Auth::user();
            $view->with('user', $user);
        });
    }
}


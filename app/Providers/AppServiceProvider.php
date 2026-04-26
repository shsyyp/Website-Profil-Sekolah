<?php

namespace App\Providers;

use App\Models\Chatbot;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer('partials.chatbot', function ($view) {
            $view->with('chatbotItems', Chatbot::latest()->get());
        });
    }
}

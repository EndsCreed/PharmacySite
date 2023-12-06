<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Component;

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
        Component::macro('successToast', function ($text = 'Submitted!') {
            $this->js(<<<JS
            Toastify({
                text: '{$text}',
                duration: 3000,
                gravity: 'bottom',
                position: 'right',
                style: {
                    background: '#1DB500'
                }
            }).showToast();
        JS
            );
        });

        Component::macro('failToast', function ($text = 'Failed!') {
            $this->js(<<<JS
            Toastify({
                text: '{$text}',
                duration: 3000,
                gravity: 'bottom',
                position: 'right',
                style: {
                    background: '#DB0000'
                }
            }).showToast();
        JS);
        });
    }
}

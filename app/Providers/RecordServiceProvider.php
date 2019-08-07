<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Record;
use App\Observers\RecordObserver;

class RecordServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Record::observe(RecordObserver::class);
    }
}

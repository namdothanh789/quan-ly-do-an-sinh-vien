<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposer\NotificationComposer;
use App\Http\ViewComposer\StudentTopicComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['page.common.nav'] , NotificationComposer::class);
        View::composer(['page.common.topic_user'] , StudentTopicComposer::class);
    }

}

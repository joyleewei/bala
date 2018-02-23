<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\Models\Topic;
use App\Observers\TopicObserver;

class AppServiceProvider extends ServiceProvider{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){
        // mysql 版本低于5.7 ，设置长度
        Schema::defaultStringLength(128);
        Carbon::setLocale('zh');
        Topic::observe( new TopicObserver );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(){
        //
    }
}
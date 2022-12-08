<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use carbon\Carbon;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('d, M Y H:i');
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    //  menentukan zona waktu jakarta (pakai dulu use carbon\Carbon)
    public function boot()
    {
        // $today = Carbon::now()->isoFormat('D MMMM Y')
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
    }
}

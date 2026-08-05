<?php

namespace App\Providers;

use App\Bindings\CustomWireUiBladeDirectives;
use App\Settings\AdvancedSettings;
use App\Settings\GeneralSettings;
use App\Settings\SeoSettings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use WireUi\WireUiBladeDirectives;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->app->bind(WireUiBladeDirectives::class, CustomWireUiBladeDirectives::class);

        Validator::extend('alpha_space_numeric', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[0-9A-Za-z\s\-]+$/', $value);
        });

        try {
            $generalSettings = new GeneralSettings();
            View::share('generalSettings', $generalSettings);
            View::share('advancedSettings', new AdvancedSettings());
            View::share('seoSettings', new SeoSettings());
            $site_language = $generalSettings->site_language ?? 'en';
        } catch (\Throwable $e) {
            $site_language = 'en';
        }

        // Set locale for application
        app()->setLocale($site_language);
        setlocale(LC_TIME, $site_language.'_'.mb_strtoupper($site_language));
    }
}

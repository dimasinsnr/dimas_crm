<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Memuat views dari setiap modul
        $modulesPath = base_path('modules');
        $modules = \File::directories($modulesPath);

        foreach ($modules as $module) {
            $moduleName = basename($module);
            $viewsPath = $module . '/Views';

            if (is_dir($viewsPath)) {
                $this->loadViewsFrom($viewsPath, $moduleName);
            }
        }
    }
}

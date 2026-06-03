<?php

namespace App\Providers;

use App\Models\Factory;
use App\Models\Employee;
use App\Observers\FactoryObserver;
use App\Observers\EmployeeObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Factory::observe(FactoryObserver::class);
        Employee::observe(EmployeeObserver::class);
    }
}

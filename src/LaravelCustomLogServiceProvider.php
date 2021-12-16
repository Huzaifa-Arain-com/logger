<?php

namespace Notify\LaravelCustomLog;


use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Notify\LaravelCustomLog\Jobs\SendExceptionEmailJob;
use Notify\LaravelCustomLog\Jobs\SendDailyFailedJobsEmailJob;

class LaravelCustomLogServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    public function boot()
    {

        if (config('custom-log.custom_log_mysql_enable')) {

            /* Binding package exception into laravel ExceptionHandler interface*/
            $this->app->bind(
                ExceptionHandler::class,
                Handler::class
            );
            /* getting fialed job exception */
            Queue::failing(function (JobFailed $event) {
                Notifications::error('laravel', 'job', collect($event->exception)->toArray());
            });

            if ($this->app->runningInConsole()) {
                $this->publishes([
                    __DIR__ . '/config/custom-log.php' => config_path('custom-log.php')
                ], 'config');

                $this->publishes([

                    __DIR__ . '/migrations/2021_12_13_000000_create_logs_table.php' => base_path('database/migrations/2021_12_13_000000s_create_logs_table.php')
                ], 'migration');


                /* commands section */
                $this->app->booted(function () {
                    $schedule = $this->app->make(Schedule::class);
                    $schedule->job(new SendExceptionEmailJob())->everyMinute();
                    // $schedule->job(new SendDailyFailedJobsEmailJob)->daily();
                });
            }
        }
    }
}

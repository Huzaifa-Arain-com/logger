<?php

namespace Notify\LaravelCustomLog;

use Carbon\Carbon;
use danielme85\LaravelLogToDB\LogToDbHandler;
use Exception;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Notify\LaravelCustomLog\Mail\ExceptionEmail;
use Notify\LaravelCustomLog\Mail\ReportEmail;
use Notify\LaravelCustomLog\Models\Log;

class LaravelCustomLogServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $loggingConfig = Config::get('logging');
        $loggingConfig['channels']['notify_notification'] = [
            'driver' => 'custom',
            'via' => LogToDbHandler::class,
            'level' => env('LOG_LEVEL', 'debug'),
            'collection' => config('custom-log.mysql.table'),
            'processors' => [
                \Notify\LaravelCustomLog\Processors\CustomProcessor::class,
            ],
        ];
        $loggingConfig['default'] = 'notify_notification';
        Config::set('logging', $loggingConfig);
    }

    public function boot()
    {
        if (config('custom-log.custom_log_mysql_enable')) {
            $this->parseConfigurations();

            Queue::failing(function (JobFailed $event) {
                FacadesLog::channel('notify_notification')->error($event->exception->getMessage(), $event->exception->getTrace());
            });
        }
        if ($this->app->runningInConsole()) {
            $this->publishRequiredFiles();
            /* commands section */
            $this->app->booted(function () {
                $this->sendEmailReport();
                $this->sendEmailsToDeveloper();
            });
        }
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'CustomLog');
    }

    protected function sendEmailsToDeveloper()
    {
        // if (config('custom-log.mysql.enable') && config('custom-log.dev-mode')) {
        //     if (Log::level('error')->dayWise()->count() > 0) {
        //         $schedule = $this->app->make(Schedule::class);
        //         $schedule->call(function () {
        //             $errors = Log::level('error')->sendable()->get();
        //             if ($errors->count() > 0) {
        //                 foreach ($errors as $error) {
        //                     Mail::to(config('custom-log.dev-emails'))->send(new ExceptionEmail($error));
        //                     $error->emailed_at = Carbon::now();
        //                     $error->save();
        //                 }
        //             }
        //         })->everyMinute();
        //     }
        // }
    }

    protected function sendEmailReport()
    {
        try {
            if (config('custom-log.mysql.enable') && Log::level('error')->dayWise()->count()) {
                $schedule = $this->app->make(Schedule::class);
                $scheduledCall = $schedule->call(function () {
                    if (config('custom-log.pm-emails') != false) {
                        Mail::to(config('custom-log.pm-emails'))->send(new ReportEmail());
                    }
                });
                if (! empty(config('custom-log.command'))) {
                    $scheduledCall->cron(config('custom-log.command'));
                } else {
                    $scheduledCall->dailyAt('10:00');
                }
                $scheduledCall->name('send_exceptions_email_report');
            }
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                throw $th;
            }
            report($th);
        }
    }

    protected function publishRequiredFiles()
    {
        $this->publishes([
            __DIR__.'/config/custom-log.php' => config_path('custom-log.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/migrations/2021_12_13_000000_create_logs_table.php' => base_path('database/migrations/2021_12_13_000000_create_logs_table.php'),
        ], 'migration');
    }

    protected function parseConfigurations()
    {
        $emails = config('custom-log.pm-emails');
        if (! is_array($emails) || $emails == false || $emails == null) {
            $emails = false;
        } else {
            $emails = array_filter($emails);
            if (count($emails) == 0) {
                $emails = false;
            } else {
                foreach ($emails as $email) {
                    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        throw new Exception("Incorrect email: $email");
                    }
                }
            }
        }
        Config::set('custom-log.pm-emails', $emails);

        $emails = config('custom-log.dev-emails');
        if (! is_array($emails) || $emails == false || $emails == null) {
            $emails = false;
        } else {
            $emails = array_filter($emails);
            if (count($emails) == 0) {
                $emails = false;
            } else {
                foreach ($emails as $email) {
                    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        throw new Exception("Incorrect email: $email");
                    }
                }
            }
        }
        Config::set('custom-log.dev-emails', $emails);

        $emails = config('custom-log.emails.cc');
        if (! is_array($emails) || $emails == false || $emails == null) {
            $emails = false;
        } else {
            $emails = array_filter($emails);
            if (count($emails) == 0) {
                $emails = false;
            } else {
                foreach ($emails as $email) {
                    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        throw new Exception("Incorrect email: $email");
                    }
                }
            }
        }
        Config::set('custom-log.emails.cc', $emails);
    }
}

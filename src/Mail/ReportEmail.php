<?php

namespace Notify\LaravelCustomLog\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Notify\LaravelCustomLog\Models\Log;

class ReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $totalErrors;

    protected $jobsFailed;

    protected $exceptions;

    public function __construct()
    {
        $this->totalErrors = Log::level('error')->dayWise()->count();
        $this->jobsFailed = Log::level('error')->dayWise()->job()->count();
        $this->exceptions = Log::level('error')->dayWise()->take(50)->get();
        Log::whereIn('id', $this->exceptions->pluck('id'))
            ->update(['emailed_at' => Carbon::now()]);
    }

    public function build()
    {
        $that = $this->view('CustomLog::emails.report')->subject(config('custom-log.emails.subject'))
            ->from(config('mail.from.address'))->with([
                'exceptions' => $this->exceptions,
                'totalErrors' => $this->totalErrors,
                'jobsFailed' => $this->jobsFailed,

            ]);
        if (count(config('custom-log.emails.cc')) > 0) {
            $that->cc(config('custom-log.emails.cc'));
        }
        if (count(config('custom-log.dev-mode')) > 0) {
            $that->bcc(config('custom-log.dev-emails'));
        }

        return $that;
    }
}

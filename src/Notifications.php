<?php

namespace Notify\LaravelCustomLog;

use Illuminate\Queue\Events\JobFailed;

class Notifications
{
    protected JobFailed $event;

    public function setEvent(JobFailed $event): self
    {
        $this->event = $event;

        return $this;
    }
}

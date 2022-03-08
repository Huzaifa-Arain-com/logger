<?php

namespace Notify\LaravelCustomLog\Processors;

use Monolog\Processor\ProcessorInterface;

class CustomProcessor implements ProcessorInterface
{
    /**
     * @return array The processed record
     */
    public function __invoke(array $record)
    {
        $record['extra'] = [
            'instance' => gethostname(),
            'remote_addr' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null,
            'user_agent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null,
            'created_by' => auth()->check() == true ? auth()->user()->id : null,
        ];

        return $record;
    }
}

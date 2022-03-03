<?php

namespace Notify\LaravelCustomLog\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct();
        $this->table = config('custom-log.mysql.table');
    }

    public function scopeDayWise($query, $created_at = null)
    {
        return $query->whereDate('created_at', $created_at ?? Carbon::today());
    }

    public function scopeMonthlyCount($query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeJob($query)
    {
        return $query->whereChannel('job');
    }

    public function scopeSendable($query)
    {
        return $query->whereNull('emailed_at');
    }

    public function scopeLevel($query, $level)
    {
        return $query->where('level_name', strtoupper($level));
    }
}

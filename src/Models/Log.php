<?php

namespace Notify\LaravelCustomLog\Models;

use Carbon\Carbon;
use danielme85\LaravelLogToDB\Models\LogToDbCreateObject;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use LogToDbCreateObject;

    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct();
        $this->table = config('custom-log.mysql.table');
    }

    public function getEmailedAtAttribute($value)
    {
        return $value != null ? Carbon::parse($value)->toDayDateTimeString() : null;
    }

    public function getCreatedAtAttribute($value)
    {
        return $value != null ? Carbon::parse($value)->toDayDateTimeString() : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return $value != null ? Carbon::parse($value)->toDayDateTimeString() : null;
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

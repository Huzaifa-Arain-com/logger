<?php

namespace Notify\LaravelCustomLog\Models;

use Carbon\Carbon;
use danielme85\LaravelLogToDB\Models\LogToDbCreateObject;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use LogToDbCreateObject;

    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('custom-log.mysql.table');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
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

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['description', 'due_date'];

    protected $dates = ['due_date'];

    public function getDueDateAttribute($value)
    {
        $timezone = optional(auth()->user())->time_zone ?? config('app.timezone');
        return Carbon::parse($value)->timezone($timezone);
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = Carbon::parse($value, \Auth::user()->time_zone)
            ->setTimezone('UTC')->format('Y-m-d H:i');

    }

}

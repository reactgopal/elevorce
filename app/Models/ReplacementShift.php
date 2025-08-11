<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ReplacementShift extends Model
{
    protected $table = 'replacement_shifts';

    protected $fillable = [
        'site_id',
        'employee_id',
        'shift_id',
        'note',
        'date',
        'status',
    ];

    public $timestamps = true;

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

     public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

}

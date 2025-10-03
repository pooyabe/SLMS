<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }

    public function datalogger()
    {
        return $this->belongsTo(DataLogger::class);
    }
}

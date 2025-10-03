<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NrpReport extends Model
{
    use HasFactory;

    protected $casts = [
        'pictures' => 'array',
        'fields' => 'array',
        'leveling' => 'array',
    ];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

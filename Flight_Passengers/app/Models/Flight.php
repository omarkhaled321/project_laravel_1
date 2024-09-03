<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $gaurded=[];

    public function passengers()
    {
        return $this->belongsToMany(Passenger::class);
    }
}

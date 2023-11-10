<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiderInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','lat','long','capture_time'
    ];
}

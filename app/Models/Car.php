<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $visible = ['id', 'license_plate_number', 'brand', 'model', 'daily_cost'];

    protected $fillable = ['license_plate_number', 'brand', 'model', 'daily_cost'];
}

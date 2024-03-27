<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeModule extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'total_quantity',
        'completed_quantity',
        'defect_quantity',
    ];
}

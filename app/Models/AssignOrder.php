<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Employee;
use App\Models\Order;

class AssignOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'employee_id',
        'assigned_quantity',
        'defect_quantity',
        'on_progress',
        'rate',
        'amount',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}

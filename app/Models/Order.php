<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

use App\Models\EmployeeModule;
use App\Models\AssignOrder;

class Order extends Model
{
    use HasFactory;

    public function getDefaultColumnName($columnName)
    {
        $query = 'SELECT COLUMN_DEFAULT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "orders" AND COLUMN_NAME = "' . $columnName . '"';
        $result = DB::select($query);

        return $result[0] -> COLUMN_DEFAULT;
    }

    public function print()
    {
        return 'laravel';
    } 

    public function employeeModule()
    {
        return $this->hasOne(EmployeeModule::class);
    }

    public function assignOrder()
    {
        return $this->hasMany(AssignOrder::class);
    }

    protected $fillable = [
        'avatar',
        'name',
        'quantity',
        'rate',
        'advance_payment',
    ];
}

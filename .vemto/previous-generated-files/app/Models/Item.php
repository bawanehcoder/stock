<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function maintenanceItems()
    {
        return $this->hasMany(MaintenanceItem::class);
    }

    public function maintenanceDepartment()
    {
        return $this->belongsTo(MaintenanceDepartment::class);
    }
}

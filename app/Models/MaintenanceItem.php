<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaintenanceItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function maintenanceDepartment()
    {
        return $this->belongsTo(MaintenanceDepartment::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function damaged()
    {
        return $this->belongsTo(Damaged::class);
    }
}

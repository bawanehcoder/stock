<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaintenanceDepartment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function maintenanceItems()
    {
        return $this->hasMany(MaintenanceItem::class)->orderBy('id','desc');;
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}

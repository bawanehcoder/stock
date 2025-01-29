<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Picqer\Barcode\BarcodeGeneratorPNG;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($order) {


            $generator = new BarcodeGeneratorPNG();
            $barcode = $generator->getBarcode($order->barcode, $generator::TYPE_CODE_128);
            $order->barcode_image = 'data:image/png;base64,' . base64_encode($barcode);
            $order->save();

        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

<?php

namespace App\Models\requisiciones;

use App\Models\requisiciones\DetailOrder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	//								marca       unidad   costo   tarifa
    protected $fillable = ['name', 'trademark', 'unit', 'cost', 'tariff', 'provider_id', 'category', 'imagen', 'description'];

    // public function getImagenAttribute($imagen)
    // {
    // 	return asset($imagen);
    // }

    public function detailorders()
    {
    	return $this->hasMany(DetailOrder::class);
    }
}

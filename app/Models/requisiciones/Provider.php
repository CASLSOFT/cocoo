<?php

namespace App\Models\requisiciones;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = ['nit', 'name', 'payment', 'ment'];
}

<?php

namespace App\Models\requisiciones;

use App\Models\requisiciones\DetailOrder;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //								                            fechaaprobacion                 fecharecibido   ordengenerada
    protected $fillable = ['numberorder','user_id', 'category', 'dateapproval',  'approval_id', 'datereceived', 'ordergenerated', 'draft', 'observations', 'status', 'responsable', 'puntuacion'];
    protected $casts = ['draft' => 'boolean'];

    public function detailorders()
    {
    	return $this->hasMany(DetailOrder::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}

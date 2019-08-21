<?php

namespace App\Models\requisiciones;

use App\Models\requisiciones\Order;
use App\Models\requisiciones\Article;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
	//												cantidad
	protected $fillable = ['article_id', 'order_id', 'quantity'];

	public function order()
	{
		return $this->belongsTo(Order::class)->select(array('id', 'draft'));
	}

	public function article()
	{
		return $this->belongsTo(Article::class)->select(array('id', 'name', 'imagen'));;
	}
}

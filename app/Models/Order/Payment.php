<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
  protected $guarded = ['id'];

  public function order(): BelongsTo
  {
    return $this->belongsTo(Order::class);
  }
}

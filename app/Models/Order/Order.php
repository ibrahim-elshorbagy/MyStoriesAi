<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
  protected $guarded = ['id'];

  protected $casts = [
    'value' => 'array',
  ];

  public function payments(): HasMany
  {
    return $this->hasMany(Payment::class);
  }

  public function shippingAddress(): HasOne
  {
    return $this->hasOne(ShippingAddress::class);
  }
}

<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Order\Payment;
use App\Models\Order\ShippingAddress;

class Order extends Model
{
  protected $guarded = ['id'];

  protected $casts = [
    'value' => 'array',
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(\App\Models\User::class);
  }

  public function payments(): HasMany
  {
    return $this->hasMany(Payment::class);
  }

  public function shippingAddress(): HasOne
  {
    return $this->hasOne(ShippingAddress::class);
  }

  public function story(): BelongsTo
  {
    return $this->belongsTo(\App\Models\Admin\Story\Story::class);
  }

}

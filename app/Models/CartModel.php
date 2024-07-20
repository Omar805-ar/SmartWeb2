<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartModel extends Model
{
    
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = ['product_id', 'merchant_id', 'quantity', 'total'];

    public function product() : BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function merchant() : BelongsTo {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }
}

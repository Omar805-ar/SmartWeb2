<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MerchantStoreProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'store_id',
        'selling_price',
    ];

    public function product() : BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function store() : BelongsTo {
        return $this->belongsTo(MerchantStore::class, 'store_id');
    }
}

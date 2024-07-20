<?php

namespace App\Models;

use App\Models\Merchant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = [
        'merchant_id',
        'country_id',
        'balance',
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'archived'
    ];
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
    public function messages()
    {
        return $this->hasMany(Chat::class, 'room_id');
    }
    // public function getArchivedAttribute($value)
    // {
    //     return $this->archived == 0 ? __('global.active') : __('global.archived');
    // }

}

<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, HasAdvancedFilter, SoftDeletes;

    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        'payment_gateway_data' => 'json'
    ];
    public const STATUS_SELECT = [
        'pending'      => 'Pending',
        'accepted'     => 'Accepted',
        'not_accepted' => 'Not_accepted',
        'in_way'       => 'In Way',
        'received'     => 'Received',
        'rejected'     => 'Rejected',
        'returned'     => 'Returned',
    ];

    public $orderable = [
        'id',
        'admin_subtotal',
        'merchant_subtotal',
        'shipping_cost',
        'admin_grand_total',
        'merchant_grand_total',
        'admin_net_profit',
        'merchant_net_profit',
        'merchant.email',
        'country.iso',
        'notes',
        'status',
    ];

    public $filterable = [
        'id',
        'admin_subtotal',
        'merchant_subtotal',
        'shipping_cost',
        'admin_grand_total',
        'merchant_grand_total',
        'admin_net_profit',
        'merchant_net_profit',
        'merchant.email',
        'country.iso',
        'notes',
        'status',
    ];

    protected $fillable = [
        'subtotal',
        'shipping_cost',
        'grand_total',
        'city',
        'address',
        'address_2',
        'notes',
        'status',
        'payment_id',

        'merchant_id',
        'country_id',
        'status',
        'client_id',
        'paid',
        'payment_method',
        'payment_gateway_data'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
    public function order_item()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function getStatusLabelAttribute($value)
    {
        return static::STATUS_SELECT[$this->status] ?? null;
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getDeletedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }
}

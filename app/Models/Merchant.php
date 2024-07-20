<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken as Model;

class Merchant extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasAdvancedFilter, SoftDeletes, HasApiTokens, Notifiable;
    protected $guard = 'merchants-api';

    public $table = 'merchants';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'referral_code',
        'merchant_code',
        'has_steps',
        'phone_verified_at',
        'wizard'
    ];
    protected $hidden = [
        'remember_token',
        'password',
    ];
    
    public $orderable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'referral_code',
    ];

    public $filterable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'referral_code',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
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

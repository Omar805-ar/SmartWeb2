<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'meta_description'];

}

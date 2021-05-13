<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'base_id',
        'classification_rate',
        'user_infos',
    ];

    public function Base()
    {
        return $this->belongsTo(Base::class);
    }
}

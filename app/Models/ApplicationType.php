<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Base;

class ApplicationType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application_name'
        
    ];

  
    public function bases()
    {
        return $this->hasMany(Base::class, 'application_types_id', 'id');
    }
}

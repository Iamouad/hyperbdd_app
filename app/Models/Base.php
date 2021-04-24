<?php

namespace App\Models;

use App\Models\User;
use App\Models\ApplicationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Base extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dbname',
        'nbimages',
        'user_id',
        'references',
        'classification_rate',
        'application_types_id',
        'description',
        'index_img_path',
        'bdd_img_path'
    ];

    public function applicationType()
    {
        return $this->belongsTo(ApplicationType::class, 'application_types_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}

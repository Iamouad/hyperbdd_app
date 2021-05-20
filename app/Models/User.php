<?php

namespace App\Models;

use App\Models\Base;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'avatar_path',
        'fax',
        'phone_number',
        'academic_career', 
        'description',
        // 'bith_date',
        'role_id',
        'validated_by_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function accepted()
    {
        return $this->validated_by_admin;
    }

    public function isInRole($role)
    {
        switch ($role) {
            case "admin":
                return $this->role_id == 1;
                break;
            case "professor":
                return $this->role_id == 2;
                break;
            case "guest":
                return $this->role_id == 3;
                break;
            
            default:
                return false;
                break;
        }
    }

    public function isOwner($base)
    {
        return $this->id == $base->user_id;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function bases()
    {
        return $this->hasMany(Base::class);
    }
}

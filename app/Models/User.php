<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'code',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function findForPassport($username) {
        return $this->where('name', $username)->first();
    }

    public function company(){
        return $this->hasOne(Company::class);
    }

    public function identity(){
        return $this->hasOne(Identity::class);
    }

    public function experiences(){
        return $this->hasMany(Experience::class);
    }
    public function user_degrees(){
        return $this->hasMany(UserDegree::class);
    }
    public function user_skills(){
        return $this->hasMany(UserSkill::class);
    }

    public function filters(){
        return $this->hasOne(ConfigFilter::class);
    }


}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'birth_date',
        'phone',
        'city',
        'state',
        'street',
        'zip_code',
        'is_admin',
        'email',
        'password',
        'expires_at'
    ];


    protected $appends = ['birth_date_format'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'expires_at',
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date_format' => 'date',
    ];

    public function getBirthDateFormatAttribute()
    {
        
        return Carbon::parse($this->birth_date)->format('d/m/Y');
    }


    public function getBeginnerAttribute()
    {
        return $this->is_beginner === "1" ? "Si" : "No";
    }


    public function tokenExpired()
    {

        return Carbon::parse($this->expires_at) < Carbon::now();
    }

}

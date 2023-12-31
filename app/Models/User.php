<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Category;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
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
        'role'
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
        'password' => 'hashed',
    ];


    //rs
    public function categories() {
        return $this->hasMany(Category::class, 'user_id');
    }

    public function carts() 
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    public function orders() 
    {
        return $this->hasMany(Order::class, 'user_id');
    }
    
    public function comments() 
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function replies() 
    {
        return $this->hasMany(Reply::class, 'user_id');
    }
}

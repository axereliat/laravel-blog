<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
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

    public function getAvatarAttribute(?string $value): string
    {
        if (null === $value) {
            $avatarUrl = 'https://via.placeholder.com/150';
            if (null !== $this->attributes['name']) {
                $avatarUrl .= '?text=' . substr($this->attributes['name'], 0, 1);
            }

            return $avatarUrl;
        }

        return $value;
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function notifications() {
        return $this->hasMany(Notification::class, 'owner_id');
    }
}

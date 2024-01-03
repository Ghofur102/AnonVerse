<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'foto_user'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function feeds() {
        return $this->hasMany(feeds::class, 'user_id');
    }

    public function sender_likes() {
        return $this->hasMany(likes::class, 'sender_id');
    }

    public function recipient_likes() {
        return $this->hasMany(likes::class, 'recipient_id');
    }

    public function sender_comment() {
        return $this->hasMany(comments::class, 'sender_id');
    }

    public function recipient_comment() {
        return $this->hasMany(comments::class, 'recipient_id');
    }


    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}

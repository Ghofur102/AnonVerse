<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class feeds extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    protected $fillable = [
        'user_id',
        'file',
        'story'
    ];

    public function User() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes() {
        return $this->hasMany(likes::class, 'feed_id');
    }

    public function comments() {
        return $this->hasMany(comments::class, 'comment_id');
    }
}

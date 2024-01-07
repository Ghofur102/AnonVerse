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
    protected $keyType = 'string';
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

    public function count_likes() {
        return likes::where('recipient_id', $this->User->id)->where('feed_id', $this->id)->count();
    }

    public function is_like($id) {
        return likes::where('recipient_id', $this->User->id)->where('feed_id', $this->id)->where('sender_id', $id)->exists();
    }

    public function comments() {
        return $this->hasMany(comments::class, 'feed_id');
    }
}

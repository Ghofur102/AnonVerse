<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;
    protected $table = "comments";
    protected $fillable = [
        "feed_id",
        "sender_id",
        "recipient_id"
    ];
    public function Sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function Recipient() {
        return $this->belongsTo(User::class, 'recipient_id');
    }
    public function feed() {
        return $this->belongsTo(feeds::class, 'feed_id');
    }

    public function comments() {
        return $this->hasMany(comments::class, 'comment_id');
    }
}

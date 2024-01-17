<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class likes extends Model
{
    use HasFactory;
    protected $table = "likes";
    protected $fillable = [
        "feed_id",
        "comment_id",
        "answer_id",
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
    public function comment() {
        return $this->belongsTo(comments::class, 'comment_id');
    }
    public function answers() {
        return $this->belongsTo(Answers::class, 'answer_id');
    }
}

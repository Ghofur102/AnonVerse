<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class comments extends Model
{
    use HasFactory;
    protected $table = "comments";
    protected $fillable = [
        "feed_id",
        "answer_id",
        "sender_id",
        "recipient_id",
        "comment",
        "parent_id",
        "parent_main_id"
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
    public function CommentChild() {
        return $this->hasMany(comments::class, 'parent_id');
    }
    public function CommentMainChild() {
        return $this->hasMany(comments::class, 'parent_main_id');
    }
    public function is_like($id) {
        return likes::where('recipient_id', $this->Recipient->id)->where('comment_id', $this->id)->where('sender_id', $id)->exists();
    }
    public function count_likes() {
        return likes::where('recipient_id', $this->Recipient->id)->where('comment_id', $this->id)->count();
    }
    public function answers() {
        return $this->belongsTo(Answers::class, 'answer_id');
    }
}

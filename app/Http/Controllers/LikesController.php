<?php

namespace App\Http\Controllers;

use App\Models\likes;
use App\Services\LikesCommentService;
use App\Services\LikesFeedService;
use App\Services\LikesService;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    protected $LikeFeed, $LikeComment;
    public function __construct(LikesFeedService $LikeFeed, LikesCommentService $LikeComment)
    {
        $this->LikeFeed = $LikeFeed;
        $this->LikeComment = $LikeComment;
    }
    public function like_feed(string $recipient, string $sender, string $feed) {
        $this->LikeFeed->like($recipient, $sender, $feed);
        return response()->json([
            'success' => true,
        ]);
    }
    public function like_comment(string $recipient, string $sender, string $comment) {
        $this->LikeComment->like($recipient, $sender, $comment);
        return response()->json([
            'success' => true,
        ]);
    }
}

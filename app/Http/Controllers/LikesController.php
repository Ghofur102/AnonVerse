<?php

namespace App\Http\Controllers;

use App\Models\likes;
use App\Services\LikesAnswerService;
use App\Services\LikesCommentService;
use App\Services\LikesFeedService;
use App\Services\LikesService;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    protected $LikeFeed, $LikeComment, $LikeAnswer;
    public function __construct(LikesFeedService $LikeFeed, LikesCommentService $LikeComment, LikesAnswerService $LikeAnswer)
    {
        $this->LikeFeed = $LikeFeed;
        $this->LikeComment = $LikeComment;
        $this->LikeAnswer = $LikeAnswer;
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
    public function like_answer(string $recipient, string $sender, string $answer) {
        $this->LikeAnswer->like($recipient, $sender, $answer);
        return response()->json([
            'success' => true,
        ]);
    }
}


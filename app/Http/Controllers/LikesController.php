<?php

namespace App\Http\Controllers;

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
    public function like_feed(Request $request) {
        $this->LikeFeed->like($request);
        return response()->json([
            'success' => true
        ]);
    }
    public function like_comment(Request $request) {
        $this->LikeComment->like($request);
        return response()->json([
            'success' => true
        ]);
    }
}

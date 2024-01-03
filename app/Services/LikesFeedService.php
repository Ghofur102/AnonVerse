<?php

namespace App\Services;

use App\Repositories\LikesRepository;
use Illuminate\Http\Request;

class LikesFeedService
{
    protected $LikesRepository;
    public function __construct(LikesRepository $LikesRepository)
    {
        $this->LikesRepository = $LikesRepository;
    }
    public function like(Request $request)
    {
        $data = [
            'sender_id' => $request->sender_id,
            'recipient_id' => $request->recipient_id,
            'feed_id' => $request->feed_id
        ];
        $check = $this->LikesRepository->IsLike($request->sender_id, $request->recipient_id, 'feed_id', $request->feed_id);
        if ($check) {
            $this->LikesRepository->DestroyLike($request->sender_id, $request->recipient_id, 'feed_id', $request->feed_id);
        } else {
            $this->LikesRepository->storeWithoutFile($data);
        }
    }
}

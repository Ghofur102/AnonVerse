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
    public function like($recipient, $sender, $feed)
    {
        $data = [
            'sender_id' => $sender,
            'recipient_id' => $recipient,
            'feed_id' => $feed
        ];
        $check = $this->LikesRepository->IsLike($sender, $recipient, 'feed_id', $feed);
        if ($check) {
            $this->LikesRepository->DestroyLike($sender, $recipient, 'feed_id', $feed);
        } else {
            $this->LikesRepository->storeWithoutFile($data);
        }
    }
}

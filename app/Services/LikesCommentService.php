<?php

namespace App\Services;

use App\Repositories\LikesRepository;
use Illuminate\Http\Request;

class LikesCommentService
{
    protected $LikesRepository;
    public function __construct(LikesRepository $LikesRepository)
    {
        $this->LikesRepository = $LikesRepository;
    }
    public function like($recipient, $sender, $comment)
    {
        $data = [
            'sender_id' => $sender,
            'recipient_id' => $recipient,
            'comment_id' => $comment
        ];
        $check = $this->LikesRepository->IsLike($sender, $recipient, 'comment_id', $comment);
        if ($check) {
            $this->LikesRepository->DestroyLike($sender, $recipient, 'comment_id', $comment);
        } else {
            $this->LikesRepository->storeWithoutFile($data);
        }
    }
}

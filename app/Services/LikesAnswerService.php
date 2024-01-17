<?php

namespace App\Services;

use App\Repositories\LikesRepository;
use Illuminate\Http\Request;

class LikesAnswerService
{
    protected $LikesRepository;
    public function __construct(LikesRepository $LikesRepository)
    {
        $this->LikesRepository = $LikesRepository;
    }
    public function like($recipient, $sender, $answer)
    {
        $data = [
            'sender_id' => $sender,
            'recipient_id' => $recipient,
            'answer_id' => $answer
        ];
        $check = $this->LikesRepository->IsLike($sender, $recipient, 'answer_id', $answer);
        if ($check) {
            $this->LikesRepository->DestroyLike($sender, $recipient, 'answer_id', $answer);
        } else {
            $this->LikesRepository->storeWithoutFile($data);
        }
    }
}

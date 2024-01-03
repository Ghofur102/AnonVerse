<?php

namespace App\Repositories;

use App\Contracts\DestroyInterface;
use App\Contracts\IsLikeInterface;
use App\Contracts\StoreInterface;
use App\Models\likes;

class LikesRepository implements StoreInterface, IsLikeInterface
{
    public function __construct()
    {
        //
    }
    public function storeWithoutFile(array $data) {
        return likes::create($data);
    }
    public function IsLike($sender, $recipient, $name_postingan ,$postingan) {
        return likes::where('sender_id', $sender)->where('recipient_id', $recipient)->where($name_postingan, $postingan)->exists();
    }
    public function DestroyLike($sender, $recipient, $name_postingan ,$postingan) {
        return likes::where('sender_id', $sender)->where('recipient_id', $recipient)->where($name_postingan, $postingan)->delete();
    }
}

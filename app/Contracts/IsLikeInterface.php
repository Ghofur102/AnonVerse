<?php

namespace App\Contracts;

interface IsLikeInterface{
    public function IsLike($sender, $recipient, $name_postingan,$postingan);
    public function DestroyLike($sender, $recipient, $name_postingan,$postingan);
}



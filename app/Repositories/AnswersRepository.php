<?php

namespace App\Repositories;

use App\Contracts\StoreInterface;
use App\Models\Answers;

class AnswersRepository implements StoreInterface
{
    public function __construct()
    {
        //
    }
    public function storeWithoutFile(array $data) {
        return Answers::create($data);
    }
}

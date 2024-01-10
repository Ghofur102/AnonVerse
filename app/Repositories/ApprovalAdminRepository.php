<?php

namespace App\Repositories;

use App\Contracts\UpdateInterface;

class ApprovalAdminRepository implements UpdateInterface
{
    public function __construct()
    {
        //
    }
    public function update(array $data, $model) {
        return $model->update($data);
    }
}

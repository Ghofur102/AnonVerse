<?php

namespace App\Repositories;

use App\Contracts\DestroyInterface;
use App\Contracts\StoreInterface;
use App\Contracts\UpdateInterface;
use App\Models\comments;
use App\Validators\AjaxValidator;

class CommentsRepository implements StoreInterface, UpdateInterface, DestroyInterface
{
    protected $AjaxValidator;
    public function __construct(AjaxValidator $AjaxValidator)
    {
        $this->AjaxValidator = $AjaxValidator;
    }
    public function storeWithoutFile(array $data)
    {
        $rules = [
            "comment" => "required|max:225",
            "parent_id" => "integer"
        ];
        $this->AjaxValidator->validate($data, $rules);
        return comments::create($data);
    }
    public function update(array $data, $model)
    {
        $rules = [
            "comment" => "required|max:225"
        ];
        $this->AjaxValidator->validate($data, $rules);
        return $model->update($data);
    }
    public function destroy($model)
    {
        return $model->delete();
    }
}

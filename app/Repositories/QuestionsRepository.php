<?php

namespace App\Repositories;

use App\Contracts\DestroyInterface;
use App\Contracts\StoreInterface;
use App\Contracts\UpdateInterface;
use App\Models\Questions;
use App\Validators\AuthenticateValidator;

class QuestionsRepository implements StoreInterface, UpdateInterface, DestroyInterface
{
    protected $validate;
    public function __construct(AuthenticateValidator $validate)
    {
        $this->validate = $validate;
    }
    public function storeWithoutFile(array $data) {
        $rules = [
            'comunity_category_id' => 'required',
            'pertanyaan' => 'required|max:225'
        ];
        $this->validate->validate($data, $rules);
        return Questions::create($data);
    }
    public function update(array $data, $model) {
        $rules = [
            'comunity_category_id' => 'required',
            'pertanyaan' => 'required|max:225'
        ];
        $this->validate->validate($data, $rules);
        return Questions::find($model)->update($data);
    }
    public function destroy($model) {
        return Questions::find($model)->delete();
    }
}

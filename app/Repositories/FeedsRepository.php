<?php

namespace App\Repositories;

use App\Contracts\DestroyInterface;
use App\Contracts\FeedsInterface;
use App\Contracts\StoreInterface;
use App\Contracts\StoreWithFileInterface;
use App\Contracts\UpdateFileInterface;
use App\Contracts\UpdateInterface;
use App\Contracts\UploadFileInterface;
use App\Models\feeds;
use App\Validators\AjaxValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FeedsRepository implements StoreInterface, StoreWithFileInterface, UpdateInterface, DestroyInterface, UploadFileInterface, UpdateFileInterface
{
    protected $validate;
    public function __construct(AjaxValidator $validate)
    {
        $this->validate = $validate;
    }
    public function upload_file($file, $destination) {
        return $file->store($destination, 'public');
    }
    public function store(array $data) {
        $rules = [
            'file' => 'nullable|max:50000|mimes:jpg,jpeg,png,mp4',
            'story' => 'required|max:225'
        ];
        $this->validate->validate($data, $rules);
        return feeds::create([
            'user_id' => Auth::user()->id,
            'file' => $this->upload_file($data['file'], 'foto-feeds'),
            'story' => $data['story']
        ]);
    }
    public function storeWithoutFile(array $data)
    {
        $rules = [
            'story' => 'required|max:225'
        ];
        $this->validate->validate($data, $rules);
        return feeds::create([
            'user_id' => Auth::user()->id,
            'story' => $data['story']
        ]);
    }
    public function update_file($file, $destination, $model) {
        return $model->update([
            'file' => $this->upload_file($file, $destination)
        ]);
    }
    public function delete_file($file) {
        return Storage::delete($file);
    }
    public function update(array $data, $model) {
        $rules = [
            'file' => 'nullable|max:50000|image|mimes:jpg,jpeg,png,gif,avif',
            'story' => 'required|max:225'
        ];
        $this->validate->validate($data, $rules);
        return $model->update([
            'story' => $data['story']
        ]);
    }
    public function destroy($model) {
        return $model->delete();
    }
}

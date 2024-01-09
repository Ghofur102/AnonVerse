<?php

namespace App\Repositories;

use App\Contracts\DestroyInterface;
use App\Contracts\StoreInterface;
use App\Contracts\UpdateInterface;
use App\Contracts\UploadFileInterface;
use App\Models\comunity_categories;
use App\Validators\AuthenticateValidator;
use Illuminate\Support\Facades\Storage;

class ComunityCategoriesRepository implements StoreInterface, UpdateInterface, DestroyInterface, UploadFileInterface
{
    protected $validate;
    public function __construct(AuthenticateValidator $validate)
    {
        $this->validate = $validate;
    }
    public function upload_file($file, $destination) {
        return $file->store($destination, 'public');
    }

    public function storeWithoutFile(array $data) {
        $rules = [
            'name_category' => 'required|max:255',
            'image_category' => 'required|image|mimes:png,jpg,jpeg,avif|max:50000'
        ];
        $this->validate->validate($data, $rules);
        return comunity_categories::create([
            'name_category' => $data['name_category'],
            'image_category' => $this->upload_file($data['image_category'], 'image_comunity_category')
        ]);
    }
    public function update_file($file, $destination, $model) {
        return comunity_categories::find($model)->update([
            'image_category' => $file->store($destination, 'public')
        ]);
    }
    public function delete_file($file) {
        return Storage::delete($file);
    }
    public function update(array $data, $model) {
        $rules = [
            'name_category' => 'required|max:255',
            'image_category' => 'nullable|image|mimes:png,jpg,jpeg,avif|max:50000'
        ];
        $this->validate->validate($data, $rules);
        return comunity_categories::find($model)->update([
            'name_category' => $data['name_category']
        ]);
    }
    public function destroy($model) {
        return comunity_categories::find($model)->delete();
    }
}

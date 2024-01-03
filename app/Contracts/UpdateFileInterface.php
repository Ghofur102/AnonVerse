<?php

namespace App\Contracts;

interface UpdateFileInterface{
    public function update_file($file, $destination, $model);
    public function delete_file($file);
}



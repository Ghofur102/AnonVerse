<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AvatarsController extends Controller
{
    public function cari_avatar() {
        $avatars = User::inRandomOrder()->get();
        return view("users.cari_avatar", compact("avatars"));
    }
    public function account_avatar() {

    }
    public function update_bio_avatar() {
        
    }
}

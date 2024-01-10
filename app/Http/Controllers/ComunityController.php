<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comunity_categories;

class ComunityController extends Controller
{
    public function index() {
        $categories = comunity_categories::all();
        return view('users.komunitas', compact('categories'));
    }
    public function show(string $name) {
        $category = comunity_categories::where('name_category', $name)->first();
        if (!$category) {
            abort('404');
        }
        return view('users.detail_komunitas', compact("category"));
    }
}

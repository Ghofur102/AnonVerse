<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comunity_categories;
use App\Models\Questions;

class ComunityController extends Controller
{
    public function index() {
        $categories = comunity_categories::all();
        return view('users.komunitas', compact('categories'));
    }
    public function show(string $name) {
        $category = comunity_categories::where('name_category', $name)->first();
        $questions = null;
        if (!$category) {
            abort('404');
        } else {
            $questions = Questions::where('status', 'aktif')->where('comunity_category_id', $category->id)->get();
        }
        return view('users.detail_komunitas', compact("category", "questions"));
    }
}

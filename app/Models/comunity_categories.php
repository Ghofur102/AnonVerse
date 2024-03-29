<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comunity_categories extends Model
{
    use HasFactory;
    protected $table = "comunity_categories";
    protected $fillable = [
        'name_category',
        'image_category'
    ];
    public function questions() {
        $this->hasMany(Questions::class, 'question_id');
    }
    public function answers() {
        $this->hasMany(Answers::class, 'comunity_category_id');
    }
}

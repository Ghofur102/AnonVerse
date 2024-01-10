<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $table = 'questions';
    protected $fillable = [
        'user_id',
        'comunity_category_id',
        'pertanyaan',
        'status'
    ];
    public function User() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comunity_category() {
        return $this->belongsTo(comunity_categories::class, 'comunity_category_id');
    }
    public function answers() {
        return $this->hasMany(Answers::class, 'question_id');
    }
}

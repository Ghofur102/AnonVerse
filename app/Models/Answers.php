<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Answers extends Model
{
    use HasFactory;
    protected $table = 'answers';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
    protected $fillable = [
        'user_id',
        'question_id',
        'jawaban',
        'comunity_category_id'
    ];
    public function User() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function question() {
        return $this->belongsTo(Questions::class, 'question_id');
    }
    public function comunity_category() {
        return $this->belongsTo(comunity_categories::class, 'comunity_category_id');
    }
    public function comments() {
        return $this->hasMany(comments::class, 'answer_id');
    }
    public function likes() {
        return $this->hasMany(comments::class, 'answer_id');
    }
}

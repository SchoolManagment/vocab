<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $fillable = [
        'word',
        'other_words',
        'translations',
        'chapter_id',
        'book_id'
    ];

    protected $casts = [
        'other_words' => 'array',
        'translations' => 'array',
    ];

    protected static function booted()
    {
        static::deleted(function ($word) {
            $word->score()->delete();
        });
    }

    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function score(){
        return $this->hasOne(Score::class);
    }

    public function arrayToList(array|string $data, string $seperator = ', '){
        $return = "";

        foreach ($data as $value) {
            $return .= $value.$seperator;
        }

        return rtrim($return, $seperator);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'word_id',
        'book_id',
        'user_id',
        'score',
    ];

    public function word(){
        return $this->belongsTo(Word::class);
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function addPoint(int $score = 1){
        $this->score += $score;
        $this->save();
    }

    public function setPoint(int $score = 1){
        $this->score = $score;
        $this->save();
    }

    public function removePoint(int $score = 1){
        $this->score -= $score;
        $this->save();
    }
}

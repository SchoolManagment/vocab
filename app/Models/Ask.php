<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ask extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'words',
        'day',
    ];

    protected $casts = [
        'words' => 'json',
        'day' => 'datetime'
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

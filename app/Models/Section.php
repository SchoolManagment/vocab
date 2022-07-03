<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'book_id',
        'parent_id',
    ];

    public function parent(){
        return $this->belongsTo(Section::class, 'id', 'parent_id');
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }
}

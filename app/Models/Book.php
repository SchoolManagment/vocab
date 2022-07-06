<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'from_lang',
        'to_lang',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function chapters(){
        return $this->hasMany(Chapter::class);
    }

    public function lang(string $param){
        $source = $this->{$param.'_lang'};
        return config('languages.'.$source, 'Lang Not Found');
    }
}

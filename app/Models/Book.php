<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    //table name
    protected $table = 'books';

    //mass asignable columns
    protected $fillable = [
        'title', 
        'author', 
        'publication_year',
        'recommendations', 
        'user_id'];

    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class);
    }
}

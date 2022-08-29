<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'author',
        'category',
        'color',
        'is_rented',
    ];

    /**
    * Get the book that has rented.
    */
    public function rented()
    {
    	return $this->hasMany(Rent::class, 'book_id');
    }
}

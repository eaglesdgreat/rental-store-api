<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'weight',
        'type',
        'condition',
        'color',
        'is_rented',
    ];

    /**
    * Get the equipment that has rented.
    */
    public function rented()
    {
    	return $this->hasMany(Rent::class, 'equipment_id');
    }
}

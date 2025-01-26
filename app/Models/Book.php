<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'author',
        'description',
        'isbn',
        'quantity_available',
    ];

    public function bookReservation(): HasMany
    {
        return $this->hasMany(BookReservation::class);
    }
}

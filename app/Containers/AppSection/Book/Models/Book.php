<?php

namespace App\Containers\AppSection\Book\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Containers\AppSection\Book\Data\Factories\BookFactory;

class Book extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return BookFactory::new();
    }

    protected $fillable = [
        'title',
        'author',
        'slug',
        'description',
        'total_pages',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function pages(): HasMany
    {
        return $this->hasMany(BookPage::class);
    }
}

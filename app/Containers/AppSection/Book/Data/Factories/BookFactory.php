<?php

namespace App\Containers\AppSection\Book\Data\Factories;

use App\Containers\AppSection\Book\Models\Book;
use App\Ship\Parents\Factories\Factory as ParentFactory;
use Illuminate\Support\Str;

/**
 * @template TModel of Book
 *
 * @extends ParentFactory<TModel>
 */
class BookFactory extends ParentFactory
{
    /** @var class-string<TModel> */
    protected $model = Book::class;

    public function definition(): array
    {
        $title = fake()->unique()->sentence(3);

        return [
            'title' => $title,
            'author' => fake()->name(),
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(),
            'total_pages' => rand(40, 100),
            'is_active' => true,
        ];
    }
}

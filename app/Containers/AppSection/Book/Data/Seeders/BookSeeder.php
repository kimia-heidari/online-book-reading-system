<?php

namespace App\Containers\AppSection\Book\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder as ParentSeeder;
use App\Containers\AppSection\Book\Models\Book;
use App\Containers\AppSection\Book\Models\BookPage;

class BookSeeder extends ParentSeeder
{
    public function run(): void
    {
        Book::factory()
        ->count(10)
        ->create()
        ->each(function (Book $book) {
            $pages = [];

            for ($page = 1; $page <= $book->total_pages; $page++) {
                $pages[] = [
                    'book_id' => $book->id,
                    'page_number' => $page,
                    'content' => fake()->paragraphs(4, true),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            BookPage::insert($pages);
        });
    }
}

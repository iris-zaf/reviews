<?php

use App\Models\User;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create or retrieve a user for seeding
        $user = User::firstOrCreate([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed books with good reviews
        Book::factory(33)->create()->each(function ($book) use ($user) {
            $this->seedReviews($book, $user, 'good');
        });

        // Seed books with average reviews
        Book::factory(33)->create()->each(function ($book) use ($user) {
            $this->seedReviews($book, $user, 'average');
        });

        // Seed books with bad reviews
        Book::factory(34)->create()->each(function ($book) use ($user) {
            $this->seedReviews($book, $user, 'bad');
        });
    }

    /**
     * Seed reviews for a book with a given rating.
     *
     * @param Book $book
     * @param User $user
     * @param string $rating
     */
    private function seedReviews(Book $book, User $user, string $rating): void
    {
        $numReviews = random_int(5, 30);

        // Generate reviews based on the rating
        Review::factory()->count($numReviews)
            ->$rating()
            ->for($book)
            ->create(['user_id' => $user->id]);
    }
}

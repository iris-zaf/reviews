@extends('layouts.app')

@section('content')
<div class="mb-4">
    <div class="flex justify-between items-start">
        <div>
            <h1 class="sticky top-0 mb-2 text-2xl">{{ $book->title }}</h1>
            <div class="book-author mb-4 text-lg font-semibold">by {{ $book->author }}</div>
            <div class="book-info mt-4">
                <div class="book-rating flex items-center">
                    <div class="mr-2 text-sm font-medium text-slate-700">
                        {{ number_format($book->reviews_avg_rating, 1) }}
                        <x-star-rating :rating="$book->reviews_avg_rating" />
                    </div>
                    <span class="book-review-count text-sm text-gray-500">
                        {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
                    </span>
                </div>
            </div>
        </div>
        <dotlottie-player src="https://lottie.host/8576966d-c8bf-4dc7-b19d-f52b6fbd18ee/OtpkEZvnu9.json"
            background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay>
        </dotlottie-player>
    </div>
</div>
<div class="mb-4">

    <a href="{{ route('books.reviews.create', $book)}}"
        class="inline-block bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">Add a
        review</a>

</div>
<div>
    <h2 class="mb-4 text-xl font-semibold">Reviews</h2>
    <ul>
        @forelse ($book->reviews as $review)
        <li class="book-item mb-4">
            <div>
                <div class="mb-2 flex items-center justify-between">
                    <div class="font-semibold">
                        <x-star-rating :rating="$review->rating" />
                    </div>
                    <div class="book-review-count">
                        {{ $review->created_at->format('M j, Y') }}
                    </div>
                </div>
                <p class="text-gray-700">{{ $review->review }}</p>
                <div class="flex items-center mt-2">
                    @if (Auth::user()->usertype == 'admin')
                    <!-- Delete Review Form -->
                    <form action="{{ route('books.reviews.destroy', [$book, $review]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                    </form>
                    @endif
                </div>
            </div>
        </li>
        @empty
        <li class="mb-4">
            <div class="empty-book-item">
                <p class="empty-text text-lg font-semibold">No reviews yet</p>
            </div>
        </li>
        @endforelse
    </ul>
</div>
@endsection
@extends('layouts.app')

@section('content')
<h1 class="mb-10 text-2xl font-bold">Add Review for {{ $book->title }}</h1>
<form method="POST" action="{{ route('books.reviews.store', $book) }}" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    <div class="mb-4">
        <label for="review">Review</label>
        <textarea name="review" id="review" required class="input mb-4"></textarea>
        @error('review')
        <p class="text-red-500 text-sm mt-1">{{ $message}}</p>

        @enderror
    </div>
    <div class="mb-4">
        <label for="rating">Rating</label>
        <select name="rating" id="rating" required class="input mb-4">
            <option value="">Select a Rating</option>
            @for($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }}</option>
                @endfor
        </select>
    </div>
    <button type="submit" class="btn">Add Review</button>
</form>
@endsection
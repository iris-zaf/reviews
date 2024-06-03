@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between ">
    <h1 class="mb-10 text-2xl">Books </h1>
    <dotlottie-player src="https://lottie.host/753807b5-b74c-482e-ac2b-167282a80db1/b6VY6tFOAO.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
</div>
<form method="GET" action="{{ route('books.index')}}" class="mb-4 flex items-center space-x-2">
    <input type="text" name="title" class="input h-10" placeholder="Search by title" value="{{ request('title')}}" />
    <input type="hidden" name="filter" value="{{ request('filter')}}" />
    <button type="submit" class="btn h-10">Search</button>
    <a href="{{route('books.index')}}" class="btn h-10">Clear</a>
</form>

<div class="filter-container mb-4 flex">
    @php
    $filters= [
    ''=>'Latest',
    'popular_last_month'=>'Popular Last Month',
    'popular_last_6months'=>'Popular Last 6 Months',
    'highest_rated_last_month'=>'Highest Rated Last Month',
    'highest_rated_last_6months'=>'Highest Rated Last 6 Months',
    ];
    @endphp
    @foreach($filters as $key=> $label)
    <a href="{{route('books.index',array_merge(request()->all(),['filter'=>$key])) }}" class="{{request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item'}}">{{ $label}}</a>
    @endforeach
</div>

<ul>
    @forelse ($books as $book)
    <li class="mb-4">
        <div class="book-item">
            <div class="flex flex-wrap items-center justify-between">
                <div class="w-full flex-grow sm:w-auto">
                    <a href="{{route('books.show', $book)}}" class="book-title">{{ $book->title}}</a>
                    <span class="book-author">by {{$book->author}}</span>
                </div>
                <div>
                    <div class="book-rating">
                        <x-star-rating :rating="$book->reviews_avg_rating" />
                    </div>
                    <div class="book-review-count">
                        out of {{$book->reviews_count}}
                        <!-- below method to convert to plural if review is more than one -->
                        {{Str::plural('review', $book->reviews_count)}}
                    </div>
                </div>
            </div>
        </div>
    </li>
    @empty
    <li class="mb-4">
        <div class="empty-book-item">
            <p class="empty-text">No books found</p>
            <a href="{{route('books.index')}}" class="reset-link">Reset criteria</a>
        </div>
    </li>
    @endforelse
</ul>
<!-- Pagination links -->
<div class="mt-4">
    {{ $books->appends(request()->query())->links()}}
</div>

@endsection

@push('scripts')
<script>
    // Listen for keydown event on the search input
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            // Prevent the default form submission behavior
            event.preventDefault();
            // Submit the form
            document.getElementById('searchForm').submit();
        }
    });
</script>
@endpush
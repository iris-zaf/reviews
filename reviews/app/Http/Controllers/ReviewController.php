<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Review;
use Carbon\Carbon;

class ReviewController extends Controller
{

    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        return view('books.reviews.create', ['book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {
        $lastReview = $request->user()->reviews()->latest()->first();

        // Check if a previous review exists
        if ($lastReview) {
            $timeDifference = Carbon::now()->diffInHours($lastReview->created_at);

            if ($timeDifference < 3) {
                // User has already added a comment within the last three hours
                return redirect()->back()->with('error', 'You can only add one comment every three hours.');
            }
        }

        // Proceed with storing the new review
        $data = $request->validate([
            'review' => 'required|min:15',
            'rating' => 'required|min:1|max:5|integer'
        ]);
        $book->reviews()->create(array_merge($data, ['user_id' => $request->user()->id]));

        return redirect()->route('books.show', $book)->with('success', 'Review created successfully.');
    }

    /**
     * Display the specified resource.
     * 
     *   @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
    
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book, Review $review)
    {
        $review->delete();

        return redirect()->route('books.show', $book)
            ->with('success', 'Review deleted successfully.');
    }
}

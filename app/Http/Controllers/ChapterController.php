<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        return view('chapter.index', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book)
    {
        return view('chapter.create', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $chapter = Chapter::create([
            'name' => $request->post('name'),
            'book_id' => $book->id,
        ]);

        return redirect()->route('book.chapter.show', compact('book', 'chapter'))->with('success', __('Chapter :chapter created', ['chapter' => $chapter->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, Chapter $chapter)
    {
        return view('chapter.show', compact('book', 'chapter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book, Chapter $chapter)
    {
        return view('chapter.edit', compact('book', 'chapter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book, Chapter $chapter)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $chapter->update([
            'name' => $request->post('name'),
        ]);

        return redirect()->route('book.chapter.show', compact('book', 'chapter'))->with('success', __('Chapter :chapter updated', ['chapter' => $chapter->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, Chapter $chapter)
    {
        $chapter->words()->delete();
        $chapter->delete();

        return redirect()->route('book.chapter.index', $book)->with('success', __('Chapter deleted.'));
    }
}

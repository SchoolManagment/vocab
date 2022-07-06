<?php

namespace App\Http\Controllers;

use App\Models\{
    Book,
    Chapter,
    Word
};
use Illuminate\Http\Request;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book, Chapter $chapter)
    {
        return view('word.index', compact('book', 'chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book, Chapter $chapter)
    {
        return view('word.create', compact('book', 'chapter'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chapter  $chapter
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, Chapter $chapter, Word $word)
    {
        return view('word.show', compact('book', 'chapter', 'word'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chapter  $chapter
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book, Chapter $chapter, Word $word)
    {
        return view('word.edit', compact('book', 'chapter', 'word'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chapter  $chapter
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, Chapter $chapter, Word $word)
    {
        $word->delete();

        return redirect()->route('book.chapter.word.index', compact('book', 'chapter'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\{
    Book,
    Section,
    Word
};
use Illuminate\Http\Request;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book, Section $section)
    {
        return view('word.index', compact('book', 'section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book, Section $section)
    {
        return view('word.create', compact('book', 'section'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, Section $section, Word $word)
    {
        return view('word.show', compact('book', 'section', 'word'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book, Section $section, Word $word)
    {
        return view('word.edit', compact('book', 'section', 'word'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, Section $section, Word $word)
    {
        $word->delete();

        return redirect()->route('book.section.word.index', compact('book', 'section'));
    }
}

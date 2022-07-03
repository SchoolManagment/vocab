<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        return view('section.index', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book)
    {
        return view('section.create', compact('book'));
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

        $section = Section::create([
            'name' => $request->post('name'),
            'book_id' => $book->id,
        ]);

        return redirect()->route('book.section.show', compact('book', 'section'))->with('success', __('Section :section created', ['section' => $section->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, Section $section)
    {
        return view('section.show', compact('book', 'section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book, Section $section)
    {
        return view('section.edit', compact('book', 'section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book, Section $section)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $section->update([
            'name' => $request->post('name'),
        ]);

        return redirect()->route('book.section.show', compact('book', 'section'))->with('success', __('Section :section updated', ['section' => $section->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, Section $section)
    {
        $section->words()->delete();
        $section->delete();

        return redirect()->route('book.section.index', $book)->with('success', __('Section deleted.'));
    }
}

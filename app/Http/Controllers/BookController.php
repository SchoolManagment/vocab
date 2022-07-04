<?php

namespace App\Http\Controllers;

use App\Models\{
    Ask,
    Book
};
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('book.index', ['books' => $request->user()->books,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    public function lang_keys(){
        $return = [];
        foreach (config('languages') as $key => $value){
            $return[] = $key;
        }

        return $return;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'to_lang' => ['required', 'string', 'max:4', Rule::in($this->lang_keys())],
            'from_lang' => ['required', 'string', 'max:4', Rule::in($this->lang_keys())],
        ]);

        $book = Book::create([
            'name' => $request->post('name'),
            'to_lang' => $request->post('to_lang'),
            'from_lang' => $request->post('from_lang'),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('book.show', $book)->with('success', "Buch erstellt.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $results = Ask::where('user_id', auth()->id())->where('book_id', $book->id)->get(['id', 'day']);
        return view('book.show', compact('book', 'results'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'to_lang' => ['required', 'string', 'max:4', Rule::in($this->lang_keys())],
            'from_lang' => ['required', 'string', 'max:4', Rule::in($this->lang_keys())],
        ]);

        $book->update($request->only('name', 'to_lang', 'from_lang'));

        return redirect()->route('book.show', $book)->with('success', "Buch aktualisiert!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('book.index')->with('success', "Buch wurde gelöscht!");
    }
}

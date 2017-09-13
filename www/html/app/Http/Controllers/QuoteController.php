<?php

namespace App\Http\Controllers;

use App\Author;
use App\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::all();

        return view('quotes.index',[
            'quotes' => $quotes
        ]);
    }

    public function postQuote(Request $request)
    {
        // Validation
        $this->validate($request, [
            'author' => 'required|max:60|alpha',
            'quote' => 'required|max:500'
        ]);

    	$authorText = ucfirst($request['author']);
    	$quoteText = $request['quote'];

    	$author = Author::where('name', $authorText)->first();

    	if(!$author){
    		$author = new Author();
    		$author->name = $authorText;
            $author->save();
    	}

        $quote = new Quote();
        $quote->quote = $quoteText;
        $author->quotes()->save($quote);

        return redirect()->route('indexQuote')->with([
            'success' => 'Quote Saved!'
        ]);
    }
}

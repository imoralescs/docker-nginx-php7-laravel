@extends('layouts.app')

@section('title')
	Trending Quotes
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
@endsection

@section('content')
@if(count($errors) > 0)
	<ul>
		@foreach($errors->all() as $error)
			{{ $error }}
		@endforeach
	</ul>
@endif
@if(Session::has('success'))
	{{ Session::get('success') }}
@endif
<section>
	<h1>Latest Quotes</h1>
	@for($i = 0; $i < count($quotes); $i++)
	<article class="quote{{ $i % 3 === 0 ? ' first-in-line' : ($i + 1) % 3 === 0 ? ' last-in-line' : '' }}">
		<div><a href="#">X</a></div>
		{{ $quotes[$i]->quote }}
		<div>Create by <a href="#">{{ $quotes[$i]->author->name }}</a> on {{ $quotes[$i]->created_at }}</div>
	</article>
	@endfor
	<div>
		Pagination
	</div>
</section>
<section>
	<h1>Add a Quote</h1>
	<form method="POST" action="{{ route('postQuote') }}">
		<div>
			<label>Your Name</label>
			<input type="text" name="author" placeholder="Your Name" />
		</div>
		<div>
			<label>Your Quote</label>
			<textarea name="quote" id="quote" rows="5" placeholder="Quote"></textarea>
		</div>
		<button type="submit">Submit Quote</button>
		<input type="hidden" name="_token" value="{{ Session::token() }}"/>
	</form>
</section>
@endsection
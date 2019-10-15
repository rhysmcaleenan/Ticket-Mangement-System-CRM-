@extends('layouts.main')

@section('content')

<main>
	<div class="container">
    	<div class="row">
    		<div class="col">
        		<h1> {{$category->name}}</h1>
   			</div>
  		</div>
	</div>


	<div class="container">
		<div class="row">
			<div class="col">
				<ul class="list-group">
					@foreach($category->articles as $article)
						<li class="list-group-item">
							<a href="{{ route('article.view', $article) }}">
							<h4>
								{{$article->title}}
							</h4>
							</a>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>

</main>

    <script
        src="{{ asset('js/jquery.js') }}"></script> 
    <script>
    </script>
       

@endsection
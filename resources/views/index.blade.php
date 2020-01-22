@extends('layouts.app')

@section('title', "{$website->title}: HowToLearnCoding !LIVE")

@push('style')
<style>
.txt-white, .txt-white * {color: white !important;}
.card, .card > * {border: none;}
.section-min-height {min-height: 80vmin;}
</style>
@endpush

@push('body')

@include('layouts.inc.header')

<div class="container-fluid p-0 text-dark" id="website_info" style="overflow: hidden;" data-with-bgimage="yes">

	<section class="container-fluid d-flex justify-content-center section-min-height" data-aos="slide-right" data-aos-offset="250" data-aos-duration="1000" data-aos-delay="0">
		<div class="row p-3 d-flex flex-row align-items-center rounded-circle animated rotateIn slow">
			<div class="col-sm-12 col-md-5 col-lg-5 animated slideInRight mb-2">
				<img src="{{ $body }}" alt="{{ $website->title }}" class="img-fluid" />
			</div>
			<div class="col-sm-12 col-md-7 col-lg-7 animated slideInLeft">
				<h3>{{ myhelper::article($articles, 'intro', 'title') }}</h3>
				{!! myhelper::article($articles, 'intro', 'article') !!}
			</div>
		</div>
	</section>

	<section class="container-fluid d-flex align-items-center justify-content-center section-min-height" data-aos="slide-left" data-aos-offset="0" data-aos-duration="500" data-aos-delay="500ms" data-colored="yes">
		<div class="row container animated headShake m-2 my-3">
			<div class="col-12 animated rotateInUpLeft d-flex justify-content-center mb-2">
				<img src="{{ $intro }}" class="img-fluid" />
			</div>
			<div class="col-12 animated zoomIn text-center">
				<h3>{{ myhelper::article($articles, 'body', 'title') }}</h3>
				{!! myhelper::article($articles, 'body', 'article') !!}
			</div>
		</div>
	</section>

	<section class="container-fluid d-flex justify-content-center section-min-height p-2" data-aos="slide-up" data-aos-offset="0" data-aos-duration="500" data-aos-delay="1s">
		<div class="row container d-flex flex-row align-items-center justify-content-center section-min-height">
			<div class="col-12 animated fadeInDownBig text-center">
				<h3>{{ myhelper::article($articles, 'last', 'title') }}</h3>
				{!! myhelper::article($articles, 'last', 'article') !!}
			</div>
			<div class="col-12 d-flex flex-row align-items-center justify-content-center animated fadeInUpBig">
				<img src="{{ $last }}" class="img-fluid" />
			</div>
		</div>
	</section>

 <!-- Extra info -->
 @if (myhelper::article($articles, 'extra'))
 <section id="extras" class="row p-2 section-min-height" data-aos="fade-in" data-aos-offset="0" data-aos-duration="500" data-aos-delay="1s">
 @foreach ($articles as $article)
  @if (strtolower($article->role) === 'extra')
  <div class="col-lg-3 col-xl-3 col-md-6 col-sm-12 my-1">
   <article class="card shadow-lg" data-aos="slide-in" data-aos-offset="0" data-aos-duration="500" data-aos-delay="1s">
    <header class="card-header" data-colored="yes">
     <h3>{{ $article->title }}</h3>
    </header>
    <main class="card-body text-dark">
     {!! $article->article !!}
    </main>
   </article>
  </div>
  @endif
 @endforeach
 </section>
 @endif
</div>

<!-- Comments -->
<section class="container-fluid section-min-height pt-4 dark-radial-gradient" data-aos="zoom-in" data-aos-offset="0" data-aos-duration="500" data-aos-delay="1s" id="commentsection">
 <h2><code>{ Comments }</code></h2>
 <div class="row">

  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 col-xl-4 rounded p-1">
   <form action="{{ route('comments.store') }}" method="POST" id="commentform{{ $website->rank }}">
    <div class="p-1">
     <button type="submit" class="btn p-1" title="Save"><img src="{{ asset('images/save.png') }}" alt="Comment save button" /></button>
    </div>

    @csrf

    <div class="input-group mb-3">
     <div class="input-group-append">
      <div class="input-group-text lead">Author's name</div>
     </div>
     <input type="text"  class="form-control" name="author" id="comment_author" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required="required" />
    </div>

    <div class="input-group mb-3">
     <div class="input-group-append">
      <div class="input-group-text lead">Author's email</div>
     </div>
     <input type="email" class="form-control" name="email" id="comment_email"  aria-label="Email imput" aria-describedby="Email input" required="required" />
    </div>

    <textarea name="content" id="comment_content" cols="30" rows="10" class="form-control rounded-bottom" required="required"></textarea>
    <input type="hidden" value="{{ $website->id }}" name="website_id" required="required" />
   </form>
  </div>

  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 col-xl-8 text-light p-0">
   <div class="card bg-transparent">
    @foreach ($comments as $comment)
    <header class="card-header dark-gradient-anim p-1 d-flex flex-row justify-content-between px-2">
     <span class="lead"><strong class="h5">{{ $comment->author }}</strong>&nbsp;<sup>{{ $comment->created_at }}</sup></span>
     <form action="{{ route('comments.destroy', ['comment' => $comment]) }}" class="btn-group" method="POST" id="deleteform{{ $comment->id }}">

      @method('DELETE')
      @csrf

      <input type="hidden" name="email" id="destroyemail{{ $comment->id }}" value="" />
      <div class="form-row btn-group">

       <a class="btn" href="{{ route('comments.show', ['comment' => $comment]) }}"><img src="{{ asset('images/view.png') }}" alt="Show comment #{{ $comment->id }}" width="16" /></a>

       <a class="btn" href="{{ route('comments.edit', ['comment' => $comment]) }}" target="_blank"><img src="{{ asset('images/edit.svg') }}" width="16" /></a>

       <button class="btn" title="Delete comment #{{ $comment->id }}" data-toggle="modal" data-target="#emailmodal" type="button"
        onclick="Comment.initRequest({{ $comment->id }}, '#deleteform{{ $comment->id }}', '#modalemail', '#destroyemail{{ $comment->id }}', Comment.modalActionImages.destroy);"><img src="{{ asset('images/delete.svg') }}" width="16" /></button>

      </div>
     </form>
    </header>
    <article style="text-indent: 1em;" class="card-body">{!! $comment->content !!}</article>
    @endforeach
   </div>
  </div>
 </div>
</section>

<footer class="container-fluid">
@if ($comments->links())
 <div class="alert">
 {{ $comments->links() }}
 </div>
@endif
 <div class="p-2 d-flex flex-row justify-content-end"><a href="#commentsection" class="btn btn-outline-light">Add a comment&nbsp;<img src="{{ asset('images/up.png') }}" width="32" /></a></div>
</footer>

@include('layouts.inc.modal')

@endpush

@push('scripts')
 @include('layouts.inc.commonjs')
@endpush
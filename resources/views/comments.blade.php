@extends('layouts.app')

@section('title', "{$website->title}: comments. How To Learn Coding !LIVE")

@include('layouts.inc.header')

@push('body')
<section class="container-fluid" data-aos="zoom-in" data-aos-offset="0" data-aos-duration="500" data-aos-delay="1s" id="commentsection">

 @include('layouts.inc.messages')

 <h2 class="py-2"><code>{ Comments }</code></h2>

 <div class="row p-1" id="commentswrapper">
  <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-xl-6 p-1 rounded container">
   <form action="{{ route('comments.store') }}" method="POST" id="commentform{{ $website->rank }}">

    @csrf

    <div class="p-1">
     <button type="submit" class="btn p-1" title="Save"><img src="{{ asset('images/save.png') }}" alt="Comment save button" /></button>
    </div>

    <div class="input-group mb-3">
     <div class="input-group-append">
      <div class="input-group-text lead">Author's name</div>
     </div>
     <input type="text"  class="form-control" name="author" id="commentauthor" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required="required" />
    </div>

    <div class="input-group mb-3">
     <div class="input-group-append">
      <div class="input-group-text lead">Author's email</div>
     </div>
     <input type="email" class="form-control" name="email" id="commentemail"  aria-label="Email imput" aria-describedby="Email input" required="required" />
    </div>

    <textarea name="content" id="comment_content" cols="30" rows="10" class="form-control rounded-bottom" required="required"></textarea>
    <input type="hidden" value="{{ $website->id }}" name="website_id" required="required" />
   </form>
  </div>

  <div class="col-12 p-0" style="max-height: 80vh; overflow-y: auto;">

   @foreach ($comments as $comment)

   <article class="card bg-dark text-light mb-1">
    <header class="card-header dark-gradient-anim d-flex flex-row justify-content-between p-0 px-2 py-1">
     <span><strong class="text-large">{{ $comment->author }}<sup>{{ $comment->created_at }}</sup></strong></span>
     <form action="{{ route('comments.destroy', ['comment' => $comment]) }}" class="btn-group" method="POST" id="deleteform{{ $comment->id }}">

      @method('DELETE')
      @csrf

      <input type="hidden" name="email" id="destroyemail{{ $comment->id }}" value="" />
      <div class="form-row btn-group">

       <a class="btn" href="{{ route('comments.edit', ['comment' => $comment]) }}" title="Edit comment #{{ $comment->id }}"><img src="{{ asset('images/edit.svg') }}" width="16" /></a>

       <button class="btn" title="Delete comment #{{ $comment->id }}" data-toggle="modal" data-target="#emailmodal" type="button"
        onclick="Comment.initRequest({{ $comment->id }}, '#deleteform{{ $comment->id }}', '#modalemail', '#destroyemail{{ $comment->id }}', Comment.modalActionImages.destroy);"><img src="{{ asset('images/delete.svg') }}" width="16" /></button>

       <a class="btn" href="{{ route('comments.show', ['comment' => $comment]) }}"><img src="{{ asset('images/view.png') }}" width="16" /></a>

      </div>
     </form>
    </header>
    <main class="card-body">
    {!! $comment->content !!}
    </main>
   </article>
   @endforeach
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

@push('csslinks')
 <link rel="stylesheet" href="{{ asset('css/gradients.css') }}" />
@endpush
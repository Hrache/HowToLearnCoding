@extends('layouts.app')

@section('title', "{$website->title} Comment #{$comment->id}")

@include('layouts.inc.header')

@push('body')
<div class="container pt-3">
 <header class="card-header rounded-0 bg-dark text-light">
  <form action="{{ route('comments.destroy', ['comment' => $comment]) }}" class="btn-group" method="POST" id="deleteform">
   @method('DELETE')
   @csrf
 	 <input type="hidden" name="email" id="destroyemail" value="" />

   <a href="{{ route('comments.edit', ['comment' => $comment]) }}" title="Edit comment #{{ $comment->id }}" class="btn">
   	<img src="{{ asset('images/edit.svg') }}" width="16" />
	 </a>

   <button title="Delete comment #{{ $comment->id }}" data-toggle="modal" data-target="#emailmodal" type="button" class="btn"
   	onclick="Comment.initRequest({{ $comment->id }}, '#deleteform', '#modalemail', '#destroyemail', Comment.modalActionImages.destroy);">
   	<img src="{{ asset('images/delete.svg') }}" width="16" />
	 </button>

  </form>
  <span><strong class="h5">{{ $comment->author }}</strong>&nbsp;<sup>{{ $comment->created_at }}</sup></span>
 </header>
 <article style="text-indent: 1em;" class="card-body alert alert-light">{!! $comment->content !!}</article>
</div>
@include('layouts.inc.modal')
@endpush

@push('scripts')
  @include('layouts.inc.commonjs')
@endpush
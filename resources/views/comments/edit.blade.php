@extends('layouts.app')

@section('title', 'Edit a comment: How to learn coding !LIVE')

@include('layouts.inc.header')

@push('body')
<section class="container p-2">
 @include('layouts.inc.messages')
 <h3 class="mb-3 text-center text-light">Edit the comment</h3>

 <form action="{{ route('comments.destroy', ['comment' => $comment]) }}" method="POST" class="btn-group p-1">
  @method('DELETE')
  @csrf
  <input type="hidden" name="email" id="destroyemail" value="" />
  <button class="btn p-1" type="button" onclick="document.querySelector('#editform').submit();" alt="Comment save button" title="Save the comment"><img src="{{ asset('images/save.png') }}" /></button>
  <button class="btn p-1" type="submit" title="Delete the comment"><img src="{{ asset('images/delete.svg') }}" width="16" /></button>
 </form>

 <form action="{{ route('comments.update', ['comment' => $comment]) }}" method="POST" id="editform">
  @method('PATCH')
  @csrf

  <div class="input-group mb-3">
   <div class="input-group-append">
    <div class="input-group-text lead lead text-right">Author's name</div>
   </div>
   <input type="text"  class="form-control" name="author" id="commentauthor" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required="required" value="{{ $comment->author }}" />
  </div>

  <div class="input-group mb-3">
   <div class="input-group-append">
    <div class="input-group-text lead">Author's email</div>
   </div>
   <input type="email" class="form-control" name="email" onchange="$('#destroyemail').val(this.value);" id="commentemail"  aria-label="Email imput" aria-describedby="Email input" required="required" />
  </div>

  <small class="text-warning">Provide the initial email of the comment.</small>
  <textarea name="content" id="comment_content" cols="30" rows="10" class="form-control rounded-bottom">{!! $comment->content !!}</textarea>
 </form>
</section>
@endpush
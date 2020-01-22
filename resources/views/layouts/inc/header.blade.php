<nav class="navbar navbar-expand-lg navbar-dark bg-dark pl-2" id="topmenu">
 <a class="p-2 animated zoomIn infinite" href="{{ route('website') }}"><img src="{{ asset('images/dummyimg.png') }}" alt="Howtolearncodinglive_logo" width="32" /></a>
 <a class="p-2 animated bounce infinite rounded text-hover text-light h4" href="{{ $website->external_url }}">{{ $website->title }}</a>
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
 </button>

 <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">

   <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="/" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Websites</a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    @foreach ($topMenuWebsites as $items)
     <a class="dropdown-item" href="{{ route('website', ['rank' => $items->rank]) }}">{{ $items->rank }}. {{ $items->title }}</a>
    @endforeach
    </div>
   </li>

   <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="/" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Comments</a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    @foreach ($topMenuWebsites as $items)
     <a class="dropdown-item" href="{{ route('comments', ['rank' => $items->rank]) }}">{{ $items->rank }}. {{ $items->title }}</a>
    @endforeach
    </div>
   </li>

   <!-- Additional links -->
   <li class="nav-item btn-group">
   @if (!Route::is(['comments.edit', 'comments.show']))
    <a class="btn btn-outline-success" style="text-decoration: none;" href="#commentsection"><img src="{{ asset('images/down.png') }}" width="32" />&nbsp;Add a comment</a>
   @endif
    <a class="btn btn-outline-success" style="text-decoration: none;" href="{{ url()->previous() }}"><img src="{{ asset('images/back.png') }}" width="32" />&nbsp;Back</a>
   </li>

  </ul>
 </div>
</nav>

<div class="animated zoomIn d-flex align-items-center justify-content-center bg-white" style="min-height: 50vmin;">
 <img src="{{ $cover }}" alt="{{ $website->title }}" class="img-fluid" height="315px" />
</div>
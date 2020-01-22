<div class="row my-2">
  <div class="col-lg-6 col-sm-12 col-xl-6-col-xs-12">
    <ul class="list-group">
      <li class="list-group-item">
        <a href="{{ route('platform.comments.latest') }}" class="text-primary">Latest comments</a>
        <span class="badge float-right">{{ $latest_comments_count }}</span>
      </li>
      <li class="list-group-item">
        <a href="{{ route('platform.websites.list') }}" class="text-primary">Websites count</a>
        <span class="badge float-right">{{ $websites_count }}</span>
      </li>
    </ul>
  </div>
</div>

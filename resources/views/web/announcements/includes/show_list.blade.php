<span class="fs-3 py-2">
    <span class="mx-3 wt064">公告</span>
</span>
<hr>
<div class="my-3" style="min-height:30vh;">
    @foreach ($announcements as $announcement)
        <div class="rounded rounded-4 shadow-sm mt-2 py-1 fs-6 border">
            <a href="{{route('announcements.show', [$announcement->id])}}"
                class="text-decoration-none link-primary fw-bold">
                <div class="row px-3 py-1">
                    <div class="col-4 col-sm-6 col-md-8 col-lg-9 text-truncate">{{$announcement->title}}</div>
                    <div class="col-8 col-sm-6 col-md-4 col-lg-3 text-end text-truncate">
                        {{substr($announcement->created_at, 0, -3)}}
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
@extends('layouts.web')

@section("content")
<span class="fs-3 py-2">
    <a class="fs-4 fw-bold text-decoration-none" href="/announcement"><i class="bi bi-house"></i></a>
    <span class="mx-3 wt064">公告內容</span>
</span>
<hr>
<span class="fs-4">{{$announcement_detail->title}}</span>
<div class="row">
    <div class="col">
        <span class="badge text-bg-primary">{{$announcement_detail->created_at}}</span>
    </div>
</div>
<div class="border shadow-sm rounded rounded-4 px-3 py-4 mt-3" style="min-height:30vh;">
    {{$announcement_detail->content}}
</div>
@endsection
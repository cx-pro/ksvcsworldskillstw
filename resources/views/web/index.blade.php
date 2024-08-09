@extends('layouts.web')
@section("title") 首頁 @endsection
@section("content")
<div class="border border-2 shadow-sm rounded rounded-5 px-3 py-4">
    @include('web.announcements.includes.show_list')
    <div class="text-center user-select-none">
        <div class="pt-3">
            <hr>
        </div>
        <a href="{{route('announcements.list')}}" class="fw-bold text-decoration-none">查看更多</a>
    </div>
</div>

<div class="border border-2 shadow-sm rounded rounded-5 px-3 py-4 mt-5">
    @include('web.collections.includes.show_list')
    <div class="text-center user-select-none">
        <div class="pt-3">
            <hr>
        </div>
        <a href="{{route('collections.list')}}" class="fw-bold text-decoration-none">查看更多</a>
    </div>
</div>

<div class="border border-2 shadow-sm rounded rounded-5 px-3 py-4 mt-5">
    @include('web.athletes.includes.show_list')
    <div class="text-center user-select-none">
        <div class="pt-3">
            <hr>
        </div>
        <a href="{{route('athletes.list')}}" class="fw-bold text-decoration-none">查看更多</a>
    </div>
</div>

@endsection
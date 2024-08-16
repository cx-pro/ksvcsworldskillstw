@php
    $user = auth()->user();
@endphp
@extends('layouts.web')
@section("title") 練習作品 @endsection
@section("content")
<span class="fs-3 py-2">
    <span class="mx-3 wt064">練習作品</span>
</span>
@if ($user && $user->isAdmin())
    <a href="{{route("admin.collections.create")}}" class="float-end fs-2 me-5">
        <i class="bi bi-plus-lg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="新增"></i>
    </a>
@endif
<hr>
<div>
    存取以下作品中屬Laravel者將登出此站。
</div>

<div class="">
    @foreach ($collections as $collection)
        @if(!isset($last_grade))
            <div class="wt064 fs-4 w-100 mt-5">{{$collection->get_grade()}}</div>
            <div class="d-flex overflow-x-scroll">
        @else
                @if ($last_grade != $collection->get_grade())
                    </div>
                    <div class="wt064 fs-4 w-100 mt-5">{{$collection->get_grade()}}</div>
                    <div class="d-flex overflow-x-scroll">
                @endif
        @endif
            @php
                $last_grade = $collection->get_grade();
                $delete_url = route("admin.collections.destory", ["id" => $collection->id]);
                $delete_id = "colldel" . $collection->id;
            @endphp
            @include("web.includes.remove_confirm")
            @include("web.collections.includes.list_card")

            @if($loop->last)
                </div>
            @endif
    @endforeach
</div>
@endsection
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

<div class="row">
    @foreach ($collections as $collection)
        @php
            $delete_url = route("admin.collections.destory", ["id" => $collection->id]);
            $delete_id = "colldel" . $collection->id;
        @endphp
        @include("web.includes.remove_confirm")
        @include("web.collections.includes.card")
    @endforeach
</div>
@endsection
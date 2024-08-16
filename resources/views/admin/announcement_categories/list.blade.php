@php
    $user = auth()->user();
@endphp
@extends("layouts.web")
@section("title")公告類別@endsection
@section("content")
<span class="fs-3 py-2">
    <span class="mx-3 wt064">公告類別</span>
</span>
@if ($user && $user->isAdmin())
    <div class="float-end">
        <a href="{{route("admin.announcement_categories.create")}}" class="fs-2 me-3 text-decoration-none">
            <i class="bi bi-plus-lg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="新增"></i>
        </a>
    </div>
@endif
<hr>
<div class="row">
    @foreach ($categories as $category)
        @include("admin.announcement_categories.includes.card")    
    @endforeach
</div>
@endsection
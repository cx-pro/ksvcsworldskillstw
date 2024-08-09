@php
    $user = auth()->user();
@endphp
@extends('layouts.web')

@section("title") 公告內容 @endsection

@section("content")
<span class="fs-3 py-2">
    <a class="fs-4 fw-bold text-decoration-none" href="{{route("announcements.list")}}"><i class="bi bi-house"></i></a>
    <span class="mx-3 wt064">公告內容</span>
</span>
@php
    $delete_url = route("admin.announcements.destory", ["id" => $announcement_detail->id]);
    $delete_id = "anndel" . $announcement_detail->id;
@endphp
@include("web.includes.remove_confirm")
@if ($user && $user->isAdmin())
    <div class="float-end me-5">

        <a href="{{route("admin.announcements.edit", ["id" => $announcement_detail->id])}}"
            class="text-decoration-none me-3">
            <i class="bi bi-pencil-square fs-4" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="編輯"></i>
        </a>
        <a data-bs-toggle="modal" data-bs-target="#anndel{{$announcement_detail->id}}">
            <i class="bi bi-trash3 text-danger fs-4" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-title="刪除"></i>
        </a>
    </div>
@endif
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
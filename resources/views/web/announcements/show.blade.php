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
    $delete_url = route("admin.announcements.destory", ["id" => $announcement->id]);
    $delete_id = "anndel" . $announcement->id;
@endphp
@include("web.includes.remove_confirm")
@if ($user && $user->isAdmin())
    <div class="float-end me-5">

        <a href="{{route("admin.announcements.edit", ["id" => $announcement->id])}}" class="text-decoration-none me-3">
            <i class="bi bi-pencil-square fs-4" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="編輯"></i>
        </a>
        <a data-bs-toggle="modal" data-bs-target="#anndel{{$announcement->id}}">
            <i class="bi bi-trash3 text-danger fs-4" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-title="刪除"></i>
        </a>
    </div>
@endif
<hr>
<span class="fs-4">{{$announcement->title}}</span>
<div class="d-flex align-items-center">
    <span class="badge me-2"
        style="background-color:{{$announcement->category()->color}}">{{$announcement->category()->name}}</span>
    <span class="badge text-bg-primary">{{$announcement->created_at}}</span>
</div>
<div class="border shadow-sm rounded rounded-4 px-3 py-4 mt-3" style="min-height:30vh;">
    {!!$announcement->content!!}
</div>
@endsection
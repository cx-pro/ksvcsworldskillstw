@php
    $user = auth()->user();
@endphp

@extends("layouts.web")
@section("title")帳戶列表@endsection

@section("content")
<span class="fs-3 py-2">
    <span class="mx-3 wt064">帳戶列表</span>
</span>

@if ($user && $user->isAdmin())
    <a href="{{route("admin.users.create")}}" class="float-end fs-2 me-5">
        <i class="bi bi-plus-lg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="新增"></i>
    </a>
@endif
<hr>
<div class="row">
    @foreach ($users as $user)
        @include("admin.users.includes.card")
    @endforeach
</div>
@endsection